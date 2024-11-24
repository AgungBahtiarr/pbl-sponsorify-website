<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RegisterSponsorTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    #[Test]
    public function test_successful_registration()
    {
        $response = $this->post('/auth/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@sponsor.com',
            'password' => 'Sponsor123!',
            'id_role' => 2
        ]);

        $this->assertDatabaseHas('users', ['email' => 'johndoe@sponsor.com']);

        $response->assertRedirect('/auth/login');
    }

    #[Test]
    public function test_password_length_validation_min()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => 'testmin@sponsor.com',
            'password' => 'Sort11',
            'id_role' => 2
        ]);

        $this->assertDatabaseMissing('users', ['email' => 'testmin@sponsor.com']);
        $response->assertRedirect('/auth/register');
    }
}
