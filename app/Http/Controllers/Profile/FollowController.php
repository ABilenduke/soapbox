<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserCollection;

class FollowController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['following', 'followers']);
    }

    public function create(User $user) {
        $authUser = request()->user();

        $attributes = ['following_id' => $user->id];

        if ($authUser->following()->where($attributes)->exists()) {
            return response()->json(['message' => 'user_already_followed'], 400);
        }

        $authUser->following()->attach($attributes);

        return response()->json(['message' => 'user_followed'], 200);
    }

    public function delete(User $user) {
        $authUser = request()->user();

        $attributes = ['following_id' => $user->id];

        if (!$authUser->following()->where($attributes)->exists()) {
            return response()->json(['message' => 'user_not_followed'], 400);
        }

        DB::table('followers')
            ->where('follower_id', '=', $authUser->id)
            ->where('following_id', '=', $user->id)
            ->delete();

        $test = $authUser->following()->where($attributes)->get();

        $authUser->following()->where($attributes)->get()->each->delete();

        return response()->json(['message' => 'user_un_followed'], 200);
    }

    public function following(User $user) {
        if ($user) {
            $following = $user->following()->paginate(15);
            return new UserCollection($following);
        }

        return response()->json(['error' => 'user_not_found'], 400);
    }

    public function followers(User $user) {
        if ($user) {
            $users = $user->followers()->paginate(15);
            return new UserCollection($users);
        }

        return response()->json(['error' => 'user_not_found'], 400);
    }
}
