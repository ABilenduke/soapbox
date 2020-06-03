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
        factory(App\Category::class)->create([
            'title' => 'Art',
            'description' => 'All about art and stuff'
        ]);

        factory(App\Category::class)->create([
            'title' => 'Science',
            'description' => 'All about science and stuff'
        ]);

        factory(App\Category::class)->create([
            'title' => 'Lifestyle',
            'description' => 'All about lifestyle and stuff'
        ]);

        factory(App\Category::class)->create([
            'title' => 'Politics',
            'description' => 'All about politics and stuff'
        ]);

        factory(App\Category::class)->create([
            'title' => 'World',
            'description' => 'All about the world and stuff'
        ]);
    }
}
