<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Category::class)->create(['title' => 'animals']);
        factory(App\Category::class)->create(['title' => 'art']);
        factory(App\Category::class)->create(['title' => 'culture']);
        factory(App\Category::class)->create(['title' => 'current_events']);
        factory(App\Category::class)->create(['title' => 'health']);
        factory(App\Category::class)->create(['title' => 'history']);
        factory(App\Category::class)->create(['title' => 'how_to']);
        factory(App\Category::class)->create(['title' => 'humour']);
        factory(App\Category::class)->create(['title' => 'music']);
        factory(App\Category::class)->create(['title' => 'nature']);
        factory(App\Category::class)->create(['title' => 'science']);
        factory(App\Category::class)->create(['title' => 'sports']);
    }
}
