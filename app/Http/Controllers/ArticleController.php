<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Category;
use App\Article;
use App\ArticleImage;
use App\ArticleContent;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index()
    {
        $articles = Article::where('is_published', true)->paginate(15);

        return response()->json(['articles' => $articles], 200);
    }

    public function show($id)
    {
        $article = Article::where('id', $id)->first();

        if ($article) {
            return response()->json(['article' => $article], 200);
        }

        return response()->json(['message' => 'article_not_found'], 400);
    }

    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required|max:255',
            'subtitle' => 'max:255',
            'description' => 'required|max:1000',
            'category' => 'required|exists:App\Category,title',
            // 'coverImage' => 'required|mimes:jpeg,jpg,png|dimensions:min_width=100,min_height=200'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid_article_creation',
                'errors' => $validator->errors()
            ], 400);
        }

        $category_id = Category::where('title', request()->category)->first()->id;

        $article = request()->user()->articles()->create([
            "title" => request()->title,
            "subtitle" => request()->subtitle,
            "description" => request()->description,
            "category_id" => $category_id
        ]);

        $articleIdentifier = $article->identifier;
        $image = \Image::make(request()->coverImage)->encode('jpg');
        $imageName = substr(md5(Carbon::now()->getTimestamp()), 0, 25);
        $imagePath = "images/articles/$articleIdentifier/$imageName.jpg";
        
        \Storage::put("public/" . $imagePath, $image);

        ArticleImage::create([
            'article_id' => $article->id,
            'path' => $imagePath,
            'is_cover' => true
        ]);

        ArticleContent::create([
            'article_id' => $article->id,
            'order' => 1,
            'content' => "Add content here."
        ]);

        return response()->json([
            'message' => 'article_created',
            'article' => $article->id
        ], 201);
    }

    public function publish($id)
    {
        $article = request()->user()->articles()->where('id', $id)->first();

        if ($article) {
            $article->update(['is_published' => true]);
            return response()->json(['message' => 'article_published'], 200);
        }

        return response()->json(['message' => 'article_not_found'], 400);
    }
}
