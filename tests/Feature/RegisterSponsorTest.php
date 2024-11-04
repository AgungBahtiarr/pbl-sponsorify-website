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

        // dd($response);

        $response->assertRedirect('/auth/login');
    }

    #[Test]
    public function test_registration_with_existing_email()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Jane Smith',
            'email' => 'agung@gmail.com',
            'password' => 'Sponsor456!',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The email has already been taken. ']);
    }

    #[Test]
    public function test_invalid_email_formats()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Alice Brown',
            'email' => 'invalid-email',
            'password' => 'Sponsor789!',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The email field must be a valid email address. ']);
    }

    #[Test]
    public function test_invalid_email_formats_tld()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Alice Brown',
            'email' => 'alice@test',
            'password' => 'Sponsor789!',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The email field must be a valid email address. ']);
    }

    #[Test]
    public function test_invalid_email_formats_without_tag()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Alice Brown',
            'email' => 'alice.test',
            'password' => 'Sponsor789!',
            'id_role' => 2
        ]);


        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The email field must be a valid email address. ']);
    }

    #[Test]
    public function test_invalid_email_formats_without_username()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Alice Brown',
            'email' => '@test.com',
            'password' => 'Sponsor789!',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The email field must be a valid email address. ']);
    }



    #[Test]
    public function test_password_length_validation_min_1()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => 'test@sponsor.com',
            'password' => 'Short1',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The password field must be at least 8 characters. ']);
    }

    #[Test]
    public function test_password_length_validation_min()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => 'testmin@sponsor.com',
            'password' => 'Short123',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/login');
    }

    #[Test]
    public function test_password_length_validation_min_plus_1()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => 'test@sponsor.com',
            'password' => 'Short1234',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/login');
    }


    #[Test]
    public function test_password_length_validation_max_min_1()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => 'test2@sponsor.com',
            'password' => '1234567891Agungtok1',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/login');
    }

    #[Test]
    public function test_password_length_validation_max()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => 'testmax@sponsor.com',
            'password' => '1234567891Agungtok12',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/login');
    }

    #[Test]
    public function test_password_length_validation_max_plus_1()
    {
        $response = $this->post('/auth/register', [
            'name' => 'Test User',
            'email' => 'test3@sponsor.com',
            'password' => '0123456789Agungtok12.',
            'id_role' => 2
        ]);


        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The password field must not be greater than 20 characters. ']);
    }

    #[Test]
    public function test_empty_name_field()
    {
        $response = $this->post('/auth/register', [
            'name' => '',
            'email' => 'empty@sponsor.com',
            'password' => 'Sponsor000!',
            'id_role' => 2
        ]);

        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The name field is required. ']);
    }

    #[Test]
    public function test_all_fields_empty()
    {
        $response = $this->post('/auth/register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'id_role' => ''
        ]);

        $response->assertRedirect('/auth/register')
            ->assertSessionHasErrors(['message' => 'The name field is required. The email field is required. The password field is required. The id role field is required. ']);
    }
}
