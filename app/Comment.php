<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, Traits\Likeable, Traits\UsesUuid;

    /**
     * Get the user that created the comment.
     */
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the user that created the comment.
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
