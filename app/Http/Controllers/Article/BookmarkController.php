<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    public function index()
    {
        $articles = request()->user()->bookmarks()->paginate(15);
        return response()->json(['articles' => $articles], 200);
    }

    public function show(Article $article)
    {
        
    }

    public function create(Article $article)
    {
        $attributes = ['user_id' => request()->user()->id];

        if ($article->bookmarks()->where($attributes)->exists()) {
            DB::table('bookmarks')
                ->where('article_id', '=', $article->id)
                ->where('user_id', '=', request()->user()->id)
                ->delete();

            return response()->json(['message' => 'article_bookmark_removed'], 200);
        }

        $article->bookmarks()->attach($attributes);
        return response()->json(['message' => 'article_bookmarked'], 200);
    }
}
