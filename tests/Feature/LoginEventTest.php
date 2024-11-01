<?php

namespace Tests\Feature;

use App\Models\User;
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



        $response->assertRedirect('/event/dashboard');
        $response->assertCookie('authUser');
    }


    public function test_user_cannot_login_with_unregistered_email()
    {
        $response = $this->post('/auth/login', [
            'email' => 'tidakterdaftar@gmail.com',
            'password' => 'PasswordTest123'
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors(['message' => 'Email belum terdaftar. ']);
    }


    public function test_user_cannot_login_with_wrong_password()
    {
        $response = $this->post('/auth/login', [
            'email' => 'agung@gmail.com',
            'password' => 'PasswordSalah123'
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors(['message' => 'Email atau Password salah. ']);
    }


    public function test_user_cannot_login_with_invalid_email_format()
    {
        $response = $this->post('/auth/login', [
            'email' => 'eventgmail.com',
            'password' => 'PasswordEvent12.'
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors(['message' => 'The email field must be a valid email address. ']);
    }


    public function test_user_cannot_login_with_empty_email()
    {
        $response = $this->post('/auth/login', [
            'email' => '',
            'password' => 'PasswordEvent12.'
        ]);
        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors([
            'message' => 'The email field is required. '
        ]);
    }


    public function test_user_cannot_login_with_empty_password()
    {
        $response = $this->post('/auth/login', [
            'email' => 'event@gmail.com',
            'password' => ''
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors([
            'message' => 'The password field is required. '
        ]);
    }


    public function test_user_cannot_login_with_both_fields_empty()
    {
        $response = $this->post('/auth/login', [
            'email' => '',
            'password' => ''
        ]);

        $response->assertSessionHasErrors([
            'message' => 'The email field is required. The password field is required. '
        ]);
    }
}
