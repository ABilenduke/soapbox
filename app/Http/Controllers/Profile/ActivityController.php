<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * Fetch the user's activity feed.
     *
     * @#param User $user
     */
    public function index(User $user)
    {
        return [
            'activities' => Activity::feed($user)
        ];
    }

    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    public function show(User $user)
    {
        $data = ['profileUser' => $user];

        if (request()->expectsJson()) {
            return $data;
        }

        return view('profiles.show', $data);
    }
}
