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

        $updatedUserInformation = [
            'email' => 'example@test.com',
            'name' => 'Jim Doe',
            'username' => 'NewUsername',
            'description' => 'This is a test description',
        ];

        $this->json('PUT', "/api/user", $updatedUserInformation)
            ->assertSuccessful();
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
