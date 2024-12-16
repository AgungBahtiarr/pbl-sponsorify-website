<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class SponsorLoginTest extends TestCase
{
    
    use RefreshDatabase;
    
    protected $token;
    protected $role;
    protected $authUser;
    public function setUp(): void
    {
        parent::setUp();
        $response = $this->post('/api/login', [
            'email' => 'b@gmail.com',
            'password' => 'butterfly123'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');
    }

    /** @test */
    public function sponsor_can_login_and_redirect_to_company_data_page()
    {
        
        $response = $this->post('/auth/login', [
            'email' => 'b@gmail.com',
            'password' => 'butterfly123'
        ]);

        $response->assertRedirect('/auth/sponsor');
        $this->assertAuthenticated();
    }

    /** @test */
    public function login_fails_with_invalid_credentials()
    {
        $response = $this->post('/auth/login', [
              'email' => 'b@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/auth/login');
    }

    /** @test */
    public function login_requires_valid_email_format()
    {
        $response = $this->post('/auth/login', [
            'email' => 'invalidemail',
            'password' => 'butterfly123'
        ]);

        $response->assertRedirect('/auth/login');
        $response->assertSessionHasErrors(['message' => 'The email field must be a valid email address. ']);
    }
}
