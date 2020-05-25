<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avatar extends Model
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
        'path',
        'user_id',
        'primary',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'primary' => 'boolean',
    ];

    /**
     * Get the user that created the article.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
