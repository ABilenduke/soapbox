<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'category_id' => App\Category::all()->random()->id,
        'title' => $faker->sentence,
        'subtitle' => $faker->sentence,
        'description' => $faker->paragraph,
        'is_published' => true
    ];
});