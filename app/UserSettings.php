<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSettings extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'dark_mode',
        'locale',
        'receive_notification_emails',
        'receive_promotional_emails',
        'account_is_public'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dark_mode' => 'boolean',
        'receive_notification_emails' => 'boolean',
        'receive_promotional_emails' => 'boolean',
        'account_is_public' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
}
