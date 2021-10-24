<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Route;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_as_admin()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post(route('api.auth.login', [
            'email' => 'akademikpsm@gmail.com',
            'password' => 'password'
        ]));

        $response->assertStatus(200);
    }
}
