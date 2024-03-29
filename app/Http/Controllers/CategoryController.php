<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'categories' => cache()->rememberForever('categories', function () {
                return Category::all();
            })
        ]);
    }
}
