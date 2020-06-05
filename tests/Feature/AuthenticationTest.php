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
    }

    private function validRegistrationParams($overrides = [])
    {
        return array_merge([
            'email' => 'test@example.com',
            'name' => 'John Doe',
            'username' => 'JohnDozer',
            'password' => 'secret_password',
            'password_confirmation' => 'secret_password',
        ], $overrides);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAUserCanRegister()
    {
        $response = $this->json('post', '/api/register', $this->validRegistrationParams());
        
        $response
            ->assertStatus(201)
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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAUserCannotRegisterWithAnExistingEmailOrUsername()
    {
        $existingUser = $this->validRegistrationParams();

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

    // public function testAUserCanResetTheirPassword()
    // {
    //     $response = $this->post('/api/account/');

    //     $response->assertStatus(200);
    // }

    public function testAUserCanLogin()
    {
        $user = create(User::class);
        $response = $this->json(
            'POST',
            '/api/login',
            [
                "email" => $user->email,
                "password" => 'password'
            ]
        );
        $response->assertStatus(200);
    }

    public function testAUserCanLogout()
    {
        $response = $this->get('/api/logout');
        $response->assertStatus(200);
    }
}
