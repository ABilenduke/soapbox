<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes,
        Traits\Likeable,
        Traits\Taggable,
        Traits\UsesUuid;

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
    protected $hidden = [
        'user_id',
        'category_id'
    ];

    protected $appends = [
        'identifier',
        'coverImage'
    ];

    /**
     * Get the user that created the article.
     */
    public function getIdentifierAttribute()
    {
        return md5($this->id . $this->created_at);
    }

    /**
     * Get the user that created the article.
     */
    public function category()
    {
        return $this->hasOne('App\Category');
    }

    /**
     * Get the user that created the article.
     */
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function images()
    {
        return $this->hasMany('App\ArticleImage');
    }

    public function getCoverImageAttribute()
    {
        $article = $this->images()->where('is_cover', true)->first();
        return $article ? $article->path : null;
    }
}
