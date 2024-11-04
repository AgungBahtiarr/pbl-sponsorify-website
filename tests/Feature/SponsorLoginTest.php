<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class SponsorLoginTest extends TestCase
{

    use RefreshDatabase;

    //TC-LogS-001
    public function test_first_time_login_redirects_to_company_data()
    {
        $response = $this->post('/auth/login', [
            'email' => 'sponsor@gmail.com',
            'password' => 'sponsor123',
        ]);

        $response->assertRedirect('/auth/sponsor');
    }

    //TC-LogS-002
    public function test_login_cannot_login_with_invalid_email_format()
    {
        $response = $this->post('/auth/login', [
            'email' => 'sponsormail.com',
            'password' => 'sponsor123',
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors(['message' => 'The email field must be a valid email address. ']);
    }

    //TC-LogS-003
    public function test_login_with_wrong_password()
    {
        $response = $this->post('/auth/login', [
            'email' => 'sponsor@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors(['message' => 'Email atau Password salah. ']);
    }

    //TC-LogS-004
    public function test_login_with_unregistered_email()
    {
        $response = $this->post('/auth/login', [
            'email' => 'sponsor122@gmail.com',
            'password' => 'sponsor123',
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors(['message' => 'Email belum terdaftar. ']);
    }

    //TC-LogS-005
    public function test_login_with_empty_form()
    {
        $response = $this->post('/auth/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors([
            'message' => 'The email field is required. The password field is required. '
        ]);
    }

    //TC-LogS-006
    public function test_login_with_empty_email()
    {
        $response = $this->post('/auth/login', [
            'email' => '',
            'password' => 'sponsor123',
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors([
            'message' => 'The email field is required. '
        ]);
    }

    //TC-LogS-007
    public function test_login_with_empty_password()
    {
        $response = $this->post('/auth/login', [
            'email' => 'sponsor@gmail.com',
            'password' => '',
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors([
            'message' => 'The password field is required. '
        ]);
    }
}
