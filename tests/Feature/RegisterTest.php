<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteExists():void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function testAlreadyAuthorized():void
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get("/register");
        $response->assertStatus(302);
    }

    public function testRequiredFields():void
    {
        $this->followingRedirects()
            ->from("/register")
            ->post("/register")
            ->assertOk()
            ->assertSeeText("The name field is required")
            ->assertSeeText("The email field is required")
            ->assertSeeText("The password field is required");
    }

    public function testInvalidEmail():void
    {
        $this->from("/register")
            ->post("/register", [
                "email" => "invalid_email"
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "email"=>"The email must be a valid email address."
            ]);
    }

    public function testPasswordConfirms():void
    {
        $this->from("/register")
            ->post("/register", [
                "email" => "test@test.com",
                "name"=>"john",
                "password"=> "12345677",
                "password_confirmation"=> "12344234"
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "password"=>"The password confirmation does not match."
            ]);

    }


    public function testEmailExists():void
    {
        $user = factory(User::class)->create();
        $this->from("/register")
            ->post("/register", [
                "email" => $user->email,
                "name"=>"john",
                "password", "12345677",
                "password_confirmation", "12345677"
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                "email"=>"The email has already been taken."
            ]);

    }

    public function testRegister():void
    {
        $user = factory(User::class)->make();
        $this->followingRedirects()
            ->from("/register")
            ->post("/register", [
                "email" => $user->email,
                "name"=>$user->name,
                "surname"=>$user->surname,
                "password"=> "12345677",
                "password_confirmation"=> "12345677"
            ])
            ->assertOk();

        $this->assertDatabaseHas("users",[
            "email"=> $user->email,
            "name"=> $user->name,
            "surname"=> $user->surname
        ]);

        $this->assertTrue(auth()->check());
    }

}
