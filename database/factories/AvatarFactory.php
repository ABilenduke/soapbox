<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Avatar;
use Faker\Generator as Faker;

$factory->define(Avatar::class, function (Faker $faker) {
    return [
        'user_id' => create(App\User::class),
        'path' => 'test/test.jpg',
        'is_primary' => true,
    ];
});
