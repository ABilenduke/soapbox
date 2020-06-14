<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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

        factory(App\User::class, 50)->create()->each(function ($user) use($endpoint, $client) {
            $response = $client->get($endpoint);
            $image = $response->getBody();
            $user->storeNewAvatar($image);
        });
    }
}
