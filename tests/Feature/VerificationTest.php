<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerificationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testVerifyEmail():void
    {
        $user = factory(User::class)->create([
            "email_verified_at"=>null
        ]);
//
//        $this->actingAs($user);

        $hash = sha1($user->email);
        $expires = now()->addMinutes(15);

        $this
            ->followingRedirects()
            ->from("/")
            ->get(route("verification.verify",[
                "id"=>$user->id,
                "hash"=>$hash
            ]));

        $user->refresh();

        $this->assertDatabaseHas("users",[
            "email"=>$user->email,
            "email_verified_at" => $user->email_verified_at
        ]);
    }
}
