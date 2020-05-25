<?php

namespace Tests\Feature;

use App\User;
use App\Mail\UserConfirmEmail;
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
            'password' => 'secret_password',
            'password_confirmation' => 'secret_password',
        ], $overrides);
    }

    /** @test */
    public function testRealMailIsNotSent()
    {
        Mail::assertNothingSent();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAUserCanCreateAnAccount()
    {
        $response = $this->json('post', '/api/auth/register/', $this->validRegistrationParams());
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
                'message' => 'signed_up_successfully'
            ]);;

        $this->assertCount(1, User::all());

        tap(
            User::first(),
            function ($user) {
                $this->assertEquals('test@example.com', $user->email);
                $this->assertEquals('John Doe', $user->name);
                $this->assertTrue(Hash::check('secret_password', $user->password));
            }
        );

        Mail::assertQueued(UserConfirmEmail::class);
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
