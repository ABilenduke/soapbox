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
use Carbon\Carbon;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable,
        SoftDeletes,
        Traits\UsesUuid;

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
        'profile_background',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'is_admin',
        'password',
        'remember_token'
    ];

    protected $appends = [
        'identifier',
        'avatar',
        'articlesCount',
        'followerCount',
        'followingCount',
        'isFollowed',
        'settings',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get the users settings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function settings()
    {
        return $this->hasOne('App\UserSettings', 'user_id', 'id');
    }

    /**
     * Get all activity for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany('App\Activity');
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

    public function bookmarks()
    {
        return $this->belongsToMany(
            'App\Article',
            'bookmarks'
        )->withTimestamps();
    }

    public function isFollowed()
    {
        if (!request() || !request()->user()) {
            return false;
        }

        return !!$this->followers()->where('follower_id', request()->user()->id)->count();
    }

    public function getSettingsAttribute()
    {
        return $this->settings()->first();
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

    /**
     * Record that the user has read the given thread.
     *
     * @param Thread $thread
     */
    public function read($thread)
    {
        cache()->forever(
            $this->visitedThreadCacheKey($thread),
            Carbon::now()
        );
    }

    /**
     * Get the path to the user's avatar.
     *
     * @param  string $avatar
     * @return string
     */
    public function getAvatarAttribute()
    {
        $avatar = $this->avatars()->where('is_primary', true)->first();
        return asset($avatar ? "/storage/$avatar->path" : '/images/site/default_avatar.jpg');
    }

    /**
     * Get the cache key for when a user reads a thread.
     *
     * @param  Thread $thread
     * @return string
     */
    public function visitedThreadCacheKey($thread)
    {
        return sprintf('users.%s.visits.%s', $this->id, $thread->id);
    }

    /**
     * Award reputation points to the model.
     *
     * @param  string $action
     */
    public function gainReputation($action)
    {
        $this->increment('reputation', config("soapbox.reputation.{$action}"));
    }

    /**
     * Reduce reputation points for the model.
     *
     * @param  string $action
     */
    public function loseReputation($action)
    {
        $this->decrement('reputation', config("soapbox.reputation.{$action}"));
    }

    public function storeNewAvatar($image) {
 
        $avatar = \Image::make($image)->resize(600, 600)->encode('jpg');
        $avatarName = substr(md5(Carbon::now()->getTimestamp()), 0, 25);
        $avatarPath = "images/avatars/$this->identifier/$avatarName.jpg";
        
        \Storage::disk('public')->put($avatarPath, $avatar, 'public');

        $this->avatars()
            ->where('is_primary', true)
            ->update(['is_primary' => false]);

        Avatar::create([
            'user_id' => $this->id,
            'path' => $avatarPath,
            'is_primary' => true
        ]);

        return $avatarPath;
    }
}
