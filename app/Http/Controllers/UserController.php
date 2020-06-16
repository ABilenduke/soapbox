<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = null;

        if ($auth = request()->user()) {
            $users = User::where('id', '<>', $auth->id)->paginate(15);
        } else {
            $users = User::paginate(16);
        }

        return response()->json(['users' => $users], 200);
    }

    public function show()
    {
        return request()->user();
    }

    public function update()
    {
        $user = request()->user();

        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'description' => ['string', 'max:255', 'spamfree'],
            'profile_background' => ['string', 'max:255', 'allowedprofileimage'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->update([
            'name' => request()->name,
            'username' => request()->username,
            'email' => request()->email,
        ]);

        if (request()->description) {
            $user->update([ 'description' => request()->description ]);
        }

        if (request()->profile_background) {
            $user->update([ 'profile_background' => request()->profile_background ]);
        }

        return response()->json(["message" => "user_updated_successfully"], 200);
    }

    public function delete()
    {
        $user = request()->user();
    }
}
