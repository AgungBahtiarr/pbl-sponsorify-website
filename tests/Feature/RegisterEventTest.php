<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RegisterEventTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Insert role menggunakan DB facade untuk memastikan
        DB::table('roles')->insert([
            'id' => 1,
            'role' => 'Event Organizer',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    // TC-Reg-01
    public function test_registrasi_dengan_input_valid()
    {
        $userData = [
            'name' => 'user123',
            'email' => 'user@example.com',
            'password' => 'Password123!',
            'id_role' => 1
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true
            ]);
    }

    // TC-Reg-02
    public function test_registrasi_dengan_format_email_tidak_valid()
    {
        $userData = [
            'name' => 'user123',
            'email' => 'userexample.com',
            'password' => 'Password123!',
            'id_role' => 1
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Registrasi gagal periksa kembail data anda'
            ]);
    }

    // TC-Reg-03
    public function test_registrasi_dengan_password_kurang_dari_8_karakter()
    {
        $userData = [
            'name' => 'user123',
            'email' => 'user@example.com',
            'password' => 'Pass1',
            'id_role' => 1
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Registrasi gagal periksa kembail data anda'
            ]);
    }

    // TC-Reg-04
    public function test_registrasi_dengan_email_yang_sudah_terdaftar()
    {
        // Buat user pertama
        User::create([
            'name' => 'Existing User',
            'email' => 'user@example.com',
            'password' => bcrypt('Password123!'),
            'id_role' => 1
        ]);

        $userData = [
            'name' => 'newuser123',
            'email' => 'user@example.com',
            'password' => 'Password123!',
            'id_role' => 1
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Registrasi gagal periksa kembail data anda'
            ]);
    }

    // TC-Reg-05
    public function test_registrasi_tanpa_nama()
    {
        $userData = [
            'name' => '',
            'email' => 'user@example.com',
            'password' => 'Password123!',
            'id_role' => 1
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Registrasi gagal periksa kembail data anda'
            ]);
    }

    // TC-Reg-06
    public function test_registrasi_dengan_semua_field_kosong()
    {
        $userData = [
            'name' => '',
            'email' => '',
            'password' => '',
            'id_role' => ''
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Registrasi gagal periksa kembail data anda'
            ]);
    }
}
