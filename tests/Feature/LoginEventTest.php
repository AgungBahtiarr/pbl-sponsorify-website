<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginEventTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_user_can_login_with_valid_credentials()
    {

        $response = $this->post('/auth/login', [
            'email' => 'agung@gmail.com',
            'password' => 'sandi123'
        ]);


        $response->assertRedirect('/event/dashboard')->assertCookie('token');
    }

    public function test_user_cannot_login_with_wrong_password()
    {
        $response = $this->post('/auth/login', [
            'email' => 'agung@gmail.com',
            'password' => 'PasswordSalah123'
        ]);

        $response->assertStatus(302)->assertRedirect('/auth/login')->assertCookieMissing('token');
    }
}
