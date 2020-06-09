<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleContent extends Model
{
    use SoftDeletes,
        Traits\UsesUuid,
        Traits\RecordsActivity;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'order',
        'content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the user that created the article.
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
