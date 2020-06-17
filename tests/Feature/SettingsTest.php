<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = create(User::class);

        $this->actingAs($this->user);
    }

    /** @test */
    public function a_user_can_update_their_dark_mode_setting()
    {
        $this->assertEquals($this->user->settings->dark_mode, false);

        $response = $this->json('put', "/api/user/settings", ['dark_mode' => true]);
        $response->assertSuccessful();

        $this->assertEquals($this->user->settings->dark_mode, true);
    }
}
