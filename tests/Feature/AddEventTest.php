<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddEventTest extends TestCase
{
    use RefreshDatabase;

    protected $token;
    protected $headers;
    protected $role;
    protected $authUser;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');


        // Login untuk mendapatkan token
        $response = $this->post('/api/login', [
            'email' => 'ab@gmail.com',
            'password' => 'adam1234'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');
    }

    public function test_can_create_event_with_valid_data()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Semarak Kemerdekaan',
            'description' => 'Semarak kemerdekaan merupakan bisnis plan tahunan yang diadakan di poliwangi oleh UKM KWU',
            'email' => 'anggotakwu@gmail.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'venue_name' => 'Gedung Poliwangi',
            'proposal' => UploadedFile::fake()->create('proposal/proposal.pdf', 10000),
            'start_date' => '2025-12-07',
            'image' => UploadedFile::fake()->image('image/poster.jpg', 1000)
        ]);

        $response->assertRedirect('/event/formDua');
    }

    public function test_cannot_create_event_with_minimum_name()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Ab',
            'description' => 'valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'venue_name' => 'Gedung Poliwangi',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2026-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertRedirect('/event/formSatu');
        $response->assertSessionHasErrors(['message' => 'Nama event minimal 3 karakter ']);
    }

}
