<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogout()
    {
        $this->actingAs(factory(User::class)->make());

        $this->followingRedirects()
            ->from("/")
            ->post("/logout")
            ->assertOk();

        $this->assertFalse(auth()->check());

    }
}
