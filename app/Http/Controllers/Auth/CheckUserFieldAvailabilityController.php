<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class CheckUserFieldAvailabilityController extends Controller
{
    public function email($email) {
      $authUser = request()->user();
      $exists = false;

      if (!$authUser || ($authUser && $authUser->email !== $email)) {
        $exists = User::where('email', $email)->exists();
      }

      return response()->json(['exists' => $exists], 200);
    }

    public function username($username) {
      $authUser = request()->user();
      $exists = false;

      if (!$authUser || ($authUser && $authUser->username !== $username)) {
        $exists = User::where('username', $username)->exists();
      }

      return response()->json(['exists' => $exists], 200);
    }
}
