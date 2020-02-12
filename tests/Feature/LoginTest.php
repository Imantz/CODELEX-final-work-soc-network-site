<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRouteExists():void
    {
        $response = $this->get('/login');
        //200 vai atveries
        $response->assertStatus(200);
    }

    public function testInvalidLogin():void
    {

        $this->followingRedirects()
            ->from("/login")
            ->post("login")
            ->assertOk()
            ->assertSeeText('The email field is required.')
            ->assertSeeText('The password field is required.');

    }

    public function testInvalidCredentialsLogin():void
    {
        $this->followingRedirects()
            ->from("/login")
            ->post("login", [
                    "email"=>"test@test.com",
                    "password"=>"123456"
                ])
            ->assertOk()
            ->assertSeeText("These credentials do not match our records.");
    }

    public function testLogin():void
    {
        $password = "codelex123";
        $user = factory(User::class)->create([
            "password"=>bcrypt($password)
            ]);

        $this->followingRedirects()
            ->from("/login")
            ->post("/login", [
                "email"=> $user->email,
                "password"=> $password
            ])
            ->assertOk();

        $this->assertTrue(auth()->check());
    }

    public function test_user_can_login()
    {
        $this->actingAs(factory(User::class)->create());

        $this->from("/login");
        $response = $this->get("/login");
        $response->assertStatus(302);
    }

}
