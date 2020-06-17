<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VerificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(
            ThrottleRequests::class
        );
    }

    /** @test */
    public function can_verify_email()
    {
        $user = create(User::class, ['email_verified_at' => null]);
        $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), ['user' => $user->username]);

        Event::fake();

        $this->postJson($url)
            ->assertSuccessful()
            ->assertJsonFragment(['status' => 'Your email has been verified!']);

        Event::assertDispatched(Verified::class, function (Verified $e) use ($user) {
            return $e->user->is($user);
        });
    }

    /** @test */
    public function can_not_verify_if_already_verified()
    {
        $user = create(User::class);
        $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), ['user' => $user->username]);

        $this->postJson($url)
            ->assertStatus(400)
            ->assertJsonFragment(['status' => 'The email is already verified.']);
    }

    /** @test */
    public function can_not_verify_if_url_has_invalid_signature()
    {
        $user = create(User::class, ['email_verified_at' => null]);

        $this->postJson("/api/email/verify/{$user->username}")
            ->assertStatus(400)
            ->assertJsonFragment(['status' => 'The verification link is invalid.']);
    }

    /** @test */
    public function resend_verification_notification()
    {
        $user = create(User::class, ['email_verified_at' => null]);

        Notification::fake();

        $this->postJson('/api/email/resend', ['email' => $user->email])
            ->assertSuccessful();

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    /** @test */
    public function can_not_resend_verification_notification_if_email_does_not_exist()
    {
        $this->postJson('/api/email/resend', ['email' => 'foo@bar.com'])
            ->assertStatus(422)
            ->assertJsonFragment(['errors' => ['email' => ['We can\'t find a user with that e-mail address.']]]);
    }

    /** @test */
    public function can_not_resend_verification_notification_if_email_already_verified()
    {
        $user = create(User::class);

        Notification::fake();

        $this->postJson('/api/email/resend', ['email' => $user->email])
            ->assertStatus(422)
            ->assertJsonFragment(['errors' => ['email' => ['The email is already verified.']]]);

        Notification::assertNotSentTo($user, VerifyEmail::class);
    }
}