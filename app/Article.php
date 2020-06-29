<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes,
        Traits\Likeable,
        Traits\Taggable,
        Traits\UsesUuid,
        Traits\RecordsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'is_published',
        'category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = [
        'identifier',
        'coverImage',
        'likesCount',
        'isLiked',
        'isBookmarked'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Get the user that created the article.
     */
    public function getIdentifierAttribute()
    {
        return md5($this->id . $this->created_at);
    }

    public function category()
    {
        return $this->hasOne('App\Category');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(
            'App\User',
            'bookmarks'
        )->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function content()
    {
        return $this->hasMany('App\ArticleContent')->orderBy('order');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function images()
    {
        return $this->hasMany('App\ArticleImage');
    }

    public function shares()
    {
        return $this->hasMany('App\Share');
    }

    public function getCoverImageAttribute()
    {
        $image = $this->images()->where('is_cover', true)->first();
        return $image ? $image->path : null;
    }

    public function storeNewImage($image, $isCover = false)
    {
        $articleImage = \Image::make($image)->encode('jpg');
        $imageName = substr(md5(Carbon::now()->getTimestamp()), 0, 25);
        $imagePath = "images/articles/{$this->identifier}/$imageName.jpg";

        \Storage::disk('public')->put($imagePath, $articleImage, 'public');

        \App\ArticleImage::create([
            'article_id' => $this->id,
            'path' => $imagePath,
            'is_cover' => $isCover
        ]);
    }

    public function isBookmarked()
    {
        return request()->user() ? !!request()->user()->bookmarks()->where('article_id', $this->id)->count() : false;
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->isBookmarked();
    }
}
