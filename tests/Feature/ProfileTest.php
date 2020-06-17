<?php

namespace Tests\Feature;

use App\User;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = create(User::class, $this->validProfileParams());

        $this->actingAs($this->user);
    }

    private function validProfileParams($overrides = [])
    {
        return array_merge([
            'email' => 'test@example.com',
            'name' => 'John Doe',
            'username' => 'JohnDozer',
            'description' => 'Just a test',
        ], $overrides);
    }

    /** @test */
    public function a_user_can_view_their_profile_information()
    {
        $response = $this->json('GET', "/api/profile/user/{$this->user->username}");

        $response
            ->assertSuccessful()
            ->assertJsonStructure(['user']);

        $fetchedUser = $response->getData()->user;

        $this->assertEquals($this->user->username, $fetchedUser->username);
    }

    /** @test */
    public function a_user_can_edit_their_profile_information()
    {
        $response = $this->json('GET', "/api/profile/user/{$this->user->username}")
            ->assertSuccessful();

        $fetchedUser = $response->getData()->user;

        $this->assertEquals($this->user->username, $fetchedUser->username);
        $this->assertEquals($this->user->name, $fetchedUser->name);
        $this->assertEquals($this->user->email, $fetchedUser->email);
        $this->assertEquals($this->user->description, $fetchedUser->description);
        $this->assertEquals($this->user->profile_background, $fetchedUser->profile_background);

        $updatedUserInformation = [
            'email' => 'example@test.com',
            'name' => 'Jim Doe',
            'username' => 'NewUsername',
            'description' => 'This is a test description',
            'profile_background' => 'profile-background-9.jpg',
        ];

        $this->json('PUT', "/api/user", $updatedUserInformation)
            ->assertSuccessful();

        tap(
            User::first(),
            function ($user) {
                $this->assertEquals('example@test.com', $user->email);
                $this->assertEquals('Jim Doe', $user->name);
                $this->assertEquals('NewUsername', $user->username);
                $this->assertEquals('This is a test description', $user->description);
                $this->assertEquals('profile-background-9.jpg', $user->profile_background);
            }
        );
    }

    /** @test */
    public function a_user_can_not_update_their_profile_with_invalid_data()
    {
        // TODO: Make this more robust, test all scenearios
        $updatedUserInformation = [
            'email' => 'exampletest.com', // Should be valid email address
            'name' => '', // A name is required
            'username' => '',  // A username is required
            'description' => 'yahoo customer support', // the description must not contain spam
            'profile_background' => 'profile_background', // the profile background image must be from the list of acceptable values
        ];

        $this->json('PUT', "/api/user", $updatedUserInformation)
            ->assertStatus(400)
            ->assertJsonFragment([
                "description" => ["The description contains spam."],
                "email" => ["The email must be a valid email address."],
                "name" => ["The name field is required."],
                "username" => ["The username field is required."],
                "profile_background" => ["The profile background image is invalid."]
            ]);
    }

    /** @test */
    public function a_user_can_upload_an_avatar()
    {
        $storageLocation = "public";

        Storage::fake($storageLocation);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->json('POST', '/api/profile/avatar', [
            'avatar' => $file,
        ])
        ->assertSuccessful()
        ->assertJsonStructure(['message', 'path']);

        $avatarPath = $response->getData()->path;
        
        // Assert the file was stored...
        Storage::disk($storageLocation)->assertExists($avatarPath);

        // Assert a file does not exist...
        Storage::disk($storageLocation)->assertMissing('missing.jpg');
    }
}
