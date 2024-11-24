<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddSponsorUnitTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }


    public function test_TC_SP_01_create_sponsor_with_valid_data()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Sponsor created successfully'
            ]);
    }

    public function test_TC_SP_02_create_sponsor_with_invalid_role()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 1
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthorized',
                'data' => 'Kesalahan pada role user'
            ]);
    }

    public function test_TC_SP_03_create_sponsor_with_invalid_email()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsormusik',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(422)
            ->assertJsonPath('data.email', ['Format email tidak valid']);
    }

    public function test_TC_SP_04_create_sponsor_with_name_exceeding_limit()
    {
        $data = [
            'name' => str_repeat('a', 256),
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(422)
            ->assertJsonPath('data.name', ['Nama sponsor maksimal 255 karakter']);
    }

    public function test_TC_SP_05_create_sponsor_with_empty_name()
    {
        $data = [
            'name' => '',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(422)
            ->assertJsonPath('data.name', ['Nama sponsor harus diisi']);
    }

    public function test_TC_SP_06_create_sponsor_with_invalid_category()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 999,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(422)
            ->assertJsonPath('data.id_category', ['Kategori yang dipilih tidak valid']);
    }

    public function test_TC_SP_07_create_sponsor_with_lower_boundary_valid()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 0,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Sponsor created successfully'
            ]);
    }

    public function test_TC_SP_08_create_sponsor_with_upper_boundary_valid()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 90,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Sponsor created successfully'
            ]);
    }

    public function test_TC_SP_09_create_sponsor_with_lower_boundary_invalid()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => -1,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(422)
            ->assertJsonPath('data.max_submission_date', ['Batas waktu pengajuan minimal 0 hari']);
    }

    public function test_TC_SP_10_create_sponsor_with_upper_boundary_invalid()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 91,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(422)
            ->assertJsonPath('data.max_submission_date', ['Batas waktu pengajuan maksimal 90 hari']);
    }

    public function test_TC_SP_11_create_sponsor_with_nominal_value()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 45,
            'image' => 'image.jpg',
            'id_user' => 2
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(201)
            ->assertJson([
                'status' => 'success',
                'message' => 'Sponsor created successfully'
            ]);
    }

    public function test_TC_SP_12_create_sponsor_with_invalid_user_id()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 999
        ];

        $response = $this->postJson('/api/sponsor', $data);

        $response->assertStatus(422)
            ->assertJsonPath('data.id_user', ['ID pengguna tidak valid']);
    }
}
