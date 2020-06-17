<?php

namespace Tests\Feature;

use App\User;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        Mail::assertNothingSent();
    }

    private function registrationParams($overrides = [])
    {
        return array_merge([
            'email' => 'test@example.com',
            'name' => 'John Doe',
            'username' => 'JohnDozer',
            'password' => 'secret_password',
            'password_confirmation' => 'secret_password',
        ], $overrides);
    }

    /** @test */
    public function a_user_can_register()
    {
        $response = $this->json('post', '/api/register', $this->registrationParams());
        
        $response
            ->assertSuccessful()
            ->assertJson([ 'status' => 'We have e-mailed your verification link!' ]);

        $this->assertCount(1, User::all());

        tap(
            User::first(),
            function ($user) {
                $this->assertEquals('test@example.com', $user->email);
                $this->assertEquals('John Doe', $user->name);
                $this->assertEquals('JohnDozer', $user->username);
                $this->assertTrue(Hash::check('secret_password', $user->password));
            }
        );
    }

    /** @test */
    public function a_user_cannot_register_with_an_existing_email_or_username()
    {
        $existingUser = $this->registrationParams();

        $user = create(User::class, [
            'email' => $existingUser['email'],
            'name' => $existingUser['name'],
            'username' => $existingUser['username'],
            'password' => $existingUser['password'],
        ]);

        $this->json('post', '/api/register', $existingUser)
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'username']);
    }
}
