<?php

namespace App;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\OAuthProvider;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable, SoftDeletes, Traits\UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_admin',
        'username',
        'email',
        'password',
        'confirmation_token',
        'confirmation_token_expiry'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'is_admin',
        'password',
        'remember_token',
        'confirmation_token',
        'confirmation_token_expiry'
    ];

    protected $appends = [
        'identifier',
        'avatar',
        'articlesCount',
        'followerCount',
        'followingCount',
        'isFollowed'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'confirmation_token_expiry' => 'datetime',
        'is_admin' => 'boolean',
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
    public function getAvatarAttribute()
    {
        $avatar = $this->avatars()->where('is_primary', true)->first();
        return $avatar ? $avatar->path: null;
    }

    public function avatars()
    {
        return $this->hasMany('App\Avatar');
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function followers()
    {
        return $this->belongsToMany(
            'App\User',
            'followers',
            'following_id',
            'follower_id'
        )->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(
            'App\User',
            'followers',
            'follower_id',
            'following_id'
        )->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function articleLikes()
    {
        return $this->hasManyThrough('App\ArticleLikes');
    }

    public function commentLikes()
    {
        return $this->hasManyThrough('App\CommentLikes');
    }

    /**
     * Get the oauth providers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oauthProviders()
    {
        return $this->hasMany(OAuthProvider::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function follow()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->likes()->where($attributes)->exists()) {
            $this->likes()->create($attributes);
        }
    }

    public function unFollow()
    {
        $attributes = ['user_id' => auth()->id()];
        $this->likes()->where($attributes)->get()->each->delete();
    }

    public function isFollowed()
    {
        if (!request() || !request()->user()) {
            return false;
        }

        return !!$this->followers()->where('follower_id', request()->user()->id)->count();
    }

    public function getIsFollowedAttribute()
    {
        return $this->isFollowed();
    }

    public function getArticlesCountAttribute()
    {
        return $this->articles->count();
    }

    public function getFollowerCountAttribute()
    {
        return $this->followers()->count();
    }

    public function getFollowingCountAttribute()
    {
        return $this->following()->count();
    }
}
