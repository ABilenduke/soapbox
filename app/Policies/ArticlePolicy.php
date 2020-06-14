<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User   $user
     * @param  \App\Article $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $article->user_id === $user->id;
    }
}
