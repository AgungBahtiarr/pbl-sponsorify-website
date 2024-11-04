<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginEventUnitTest extends TestCase
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

        $response = $this->post('/api/login', [
            'email' => 'agung@gmail.com',
            'password' => 'sandi123'
        ]);

        $response->assertStatus(200)->assertJsonFragment([
            'success' => true,
            'message' => 'Login Berhasil',
        ]);
    }


    public function test_user_cannot_login_with_unregistered_email()
    {
        $response = $this->post('/api/login', [
            'email' => 'tidakterdaftar@gmail.com',
            'password' => 'PasswordTest123'
        ]);

        $response->assertStatus(401)->assertJsonFragment([
            'success' => false,
            'message' => 'Login gagal, silahkan login kembali',
            'data' => [
                ['Email belum terdaftar.']
            ]
        ]);
    }


    public function test_user_cannot_login_with_wrong_password()
    {
        $response = $this->post('/api/login', [
            'email' => 'agung@gmail.com',
            'password' => 'PasswordSalah123'
        ]);

        $response->assertStatus(401)->assertJsonFragment([
            'success' => false,
            'message' => 'Login gagal, silahkan login kembali',
            'data' => [
                ['Email atau Password salah.']
            ]
        ]);
    }


    public function test_user_cannot_login_with_invalid_email_format()
    {
        $response = $this->post('/api/login', [
            'email' => 'eventgmail.com',
            'password' => 'PasswordEvent12.'
        ]);

        $response->assertStatus(401)->assertSeeText("The email field must be a valid email address.");
    }


    public function test_user_cannot_login_with_empty_email()
    {
        $response = $this->post('/api/login', [
            'email' => '',
            'password' => 'PasswordEvent12.'
        ]);
        $response->assertStatus(401)->assertSeeText(
            'The email field is required.'
        );
    }


    public function test_user_cannot_login_with_empty_password()
    {
        $response = $this->post('/api/login', [
            'email' => 'event@gmail.com',
            'password' => ''
        ]);

        $response->assertStatus(401)->assertSeeText('The password field is required.');
    }


    public function test_user_cannot_login_with_both_fields_empty()
    {
        $response = $this->post('/api/login', [
            'email' => '',
            'password' => ''
        ]);

        $response->assertStatus(401)->assertSeeText(
            ['The email field is required.'],
            ['The password field is required.']
        );
    }
}
