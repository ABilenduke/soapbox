<?php

namespace Tests\Unit;

use App\User;
use App\Avatar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_defualt_avatar_if_they_have_not_uploaded_their_own()
    {
        $user = create(User::class);

        $this->assertEquals(asset('images/site/default_avatar.jpg'), $user->avatar);
    }

    /** @test */
    public function a_user_can_determine_their_avatar_path()
    {
        $user = create(User::class);
        create(Avatar::class, [
            'user_id' => $user->id,
            'path' => 'test/test.jpg',
            'is_primary' => true
        ]);

        $this->assertEquals(asset('storage/test/test.jpg'), $user->avatar);
    }
}
