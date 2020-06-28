<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use App\Category;
use App\Share;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\User */
    protected $user;
    protected $types = [
        'email',
        'facebook',
        'link',
        'linkedin',
        'pinterest',
        'reddit',
        'twitter'
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->user = create(User::class);

        $this->actingAs($this->user);

        create(Category::class);
    }

    /** @test */
    public function a_user_cannot_share_an_article_with_an_invalid_type()
    {
        $article = create(Article::class);
        $response = $this->json('POST', "/api/article/{$article->id}/share", [
            'type' => 'invalid',
        ]);

        $response
            ->assertStatus(400)
            ->assertJsonValidationErrors(['type']);
    }

    /** @test */
    public function a_user_can_share_an_article_and_the_action_will_be_recorded()
    {
        $article = create(Article::class, ['user_id' => create(User::class)->id]);

        foreach($this->types as $type) {
            $response = $this->json('POST', "/api/article/{$article->id}/share", [
                'type' => $type,
            ]);

            $response
                ->assertSuccessful()
                ->assertJson(['message' => 'share_saved']);
            
            $this->assertEquals(Share::where('article_id', $article->id)->where('platform', $type)->exists(), true);
        }
    }

    /** @test */
    public function a_user_can_bookmark_and_unbookmark_an_article()
    {
        $article = create(Article::class, ['user_id' => create(User::class)->id]);

        $response = $this->json('POST', "/api/article/{$article->id}/bookmark");
        $response
            ->assertSuccessful()
            ->assertJson(['message' => 'article_bookmarked']);

        $response = $this->json('POST', "/api/article/{$article->id}/bookmark");
        $response
            ->assertSuccessful()
            ->assertJson(['message' => 'article_bookmark_removed']);
    }

    /** @test */
    public function a_user_can_view_all_bookmarked_articles()
    {
        $article = create(Article::class, ['user_id' => create(User::class)->id]);

        foreach($this->types as $type) {
            $response = $this->json('POST', "/api/article/{$article->id}/share", [
                'type' => $type,
            ]);

            $response
                ->assertSuccessful()
                ->assertJson(['message' => 'share_saved']);
            
            $this->assertEquals(Share::where('article_id', $article->id)->where('platform', $type)->exists(), true);
        }
    }

    /** @test */
    public function a_user_can_like_and_unlike_an_article()
    {
        $article = create(Article::class, ['user_id' => create(User::class)->id]);

        $response = $this->json('POST', "/api/article/{$article->id}/like");
        $response
            ->assertSuccessful()
            ->assertJson(['message' => 'article_liked']);
        
        $response = $this->json('POST', "/api/article/{$article->id}/like");
        $response
            ->assertSuccessful()
            ->assertJson(['message' => 'article_unliked']);

        $response = $this->json('POST', "/api/article/{$article->id}/like");
        $response
            ->assertSuccessful()
            ->assertJson(['message' => 'article_liked']);
    }
}
