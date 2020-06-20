<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Article;
use App\ArticleContent;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    public function index($id)
    {
        $article = Article::where('id', $id)->first();

        if ($article) {
            return response()->json(['content' => $article->content()->get()], 200);
        }

        return response()->json(['message' => 'article_not_found'], 400);
    }

    public function create($id)
    {
        $article = request()->user()->articles()->where('id', $id)->first();

        if ($article && $article->content()->count() < 5) {
            $content = ArticleContent::create([
                'article_id' => $article->id,
                'order' => request()->highestOrder += 1,
                'content' => "Add content here."
            ]);
            
            return response()->json([
                'message' => 'content_created',
                'content' => $content
            ], 201);
        }

        return response()->json(['message' => 'article_not_found'], 400);
    }

    public function update($id)
    {
        $articleContent = ArticleContent::where('id', $id)->first();
        $isUsersContent = $articleContent->article->user->id === request()->user()->id;
        
        if ($articleContent && $isUsersContent) {
            $newContent = request()->content;

            $status = $articleContent->update([
                'content' => $newContent
            ]);

            if ($status) {
                return response()->json(['message' => 'article_content_updated'], 200);
            }
        }

        return response()->json(['message' => 'article_content_not_found'], 400);
    }
}
