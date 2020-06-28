<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;

class LikeController extends Controller
{
    public function create(Article $article)
    {
        if ($article->isLiked()) {
            $article->unLike();
            return response()->json(['message' => 'article_unliked'], 200);
        }

        $article->like();
        return response()->json(['message' => 'article_liked'], 200);
    }
}
