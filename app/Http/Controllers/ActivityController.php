<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index() {
        return response()->json('HI', 200);
    }
}
