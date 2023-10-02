<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_user_is_admin(): void
    {
        $user = User::find(1);

       $this->assertEquals(true, $user->isAdmin());
    }

    public function test_if_user_is_not_admin(): void
    {
        $user = User::find(2);

       $this->assertEquals(false, $user->isAdmin());

       $user2 = User::find(3);

       $this->assertEquals(false, $user2->isAdmin());
    }
}
