<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    use Traits\RecordsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'path',
        'is_cover',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'article_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_cover' => 'boolean',
    ];

    /**
     * Get the user that created the article.
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
