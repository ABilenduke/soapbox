<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testAUserCanDetermineTheirAvatarPath()
    {
        $user = create(User::class);

        $this->assertEquals(asset('images/avatars/default.svg'), $user->avatar_path);

        $user->avatar_path = 'avatars/me.jpg';

        $this->assertEquals(asset('avatars/me.jpg'), $user->avatar_path);
    }

    /** @test */
    public function testAUserHasADefualtAvatarIfTheyHaveNotUploadedTheirOwn()
    {
        $user = create(User::class);

        $this->assertEquals(asset('images/avatars/default.svg'), $user->avatar_path);

        $user->avatar_path = 'avatars/me.jpg';

        $this->assertEquals(asset('avatars/me.jpg'), $user->avatar_path);
    }
}
