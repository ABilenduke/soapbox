<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class TopContributorsController extends Controller
{
    public function index()
    {
        return response()->json([
            'top_contributors' => User::limit(5)->orderBy('reputation', 'desc')->get()
        ], 200);
    }
}
