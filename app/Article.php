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

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
