<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function show(User $user) {
        if ($user) {
            return response()->json(['user' => $user], 200);
        }

        return response()->json(['message' => 'user_not_found'], 400);
    }
}
