<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    protected $user = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = request()->user();
    }

    public function index()
    {
        $articles = $this->user->articles()->paginate(10);

        if ($articles) {
            return response()->json(['articles' => $articles], 200);
        }

        return response()->json(['message' => 'articles_not_found'], 400);
    }

    public function drafts()
    {
        $articles = $this->user->articles()->where('is_published', false)->paginate(10);

        if ($articles) {
            return response()->json(['contents' => $articles], 200);
        }

        return response()->json(['message' => 'articles_not_found'], 400);
    }

    public function published()
    {
        $articles = $this->user->articles()->where('is_published', true)->paginate(10);

        if ($articles) {
            return response()->json(['contents' => $articles], 200);
        }

        return response()->json(['message' => 'articles_not_found'], 400);
    }
}
