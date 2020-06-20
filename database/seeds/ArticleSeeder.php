<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $endpoint = 'https://source.unsplash.com/random';
        $client = new \GuzzleHttp\Client();

        factory(App\Article::class, 50)->create()->each(function ($article) use($endpoint, $client) {
            $response = $client->get($endpoint);
            $image = $response->getBody();
            $article->storeNewImage($image, true);

            App\ArticleContent::create([
                'article_id' => $article->id,
                'order' => 1,
                'content' => "Add content here."
            ]);
        });
    }
}
