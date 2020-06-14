<?php

namespace Tests\Feature;

use App\User;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class ProfileTest extends TestCase
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
}
