<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);


        $response = $this->get('/password/reset/' . $token);

        $response->assertStatus(200);
    }

    public function testRequiredFields()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);

        $this
            ->from("/password/reset/" . $token)
            ->post("/password/reset")
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "email" => "The email field is required.",
                "password"=>"The password field is required.",
            ]);
    }

    public function testPasswordsDontMatch()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);

        $this
            ->from("/password/reset/" . $token)
            ->post("/password/reset",[
                "email"=>$user->email,
                "password"=>"123123123",
                "password_confirmation"=>"123123222123"
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "password"=>"The password confirmation does not match.",
            ]);
    }

    public function test_successful_password_reset()
    {
        $user = factory(User::class)->create();
        $token = Password::createToken($user);

        $this->followingRedirects()
            ->from("/password/reset/" . $token)
            ->post("/password/reset",[
                "email"=>$user->email,
                "password"=>"123123123",
                "password_confirmation"=>"123123123"
            ])
            ->assertOk();

        $this->assertDatabaseHas("users",[
           "email"=>$user->email,
            "password"=>Hash::check("123123123", $user->password)
        ]);
    }
}
