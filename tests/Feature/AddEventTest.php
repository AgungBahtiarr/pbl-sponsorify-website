<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cookie;
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
            'email' => 'agung@gmail.com',
            'password' => 'sandi123'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');

        // Cookie::queue('token', $this->token);
        // Cookie::queue('roleUser', $this->role);
        Cookie::queue(Cookie::make('token', $this->token));
        Cookie::queue(Cookie::make('authUser', $this->authUser));
        Cookie::queue(Cookie::make('roleUser', $this->role));

        // dd($this->role);

        // $this->headers = ['Authorization' => 'Bearer ' . $this->token];
    }

    public function test_can_create_event_with_valid_data()
    {

        // $token = Cookie::get('token');

        // dd($token);

        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Semarak Kemerdekaan',
            'description' => 'Semarak kemerdekaan merupakan bisnis plan tahunan yang diadakan di poliwangi oleh UKM KWU',
            'email' => 'anggotakwu@gmail.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal/proposal.pdf', 10000),
            'start_date' => '2024-12-07',
            'image' => UploadedFile::fake()->image('image/poster.jpg', 1000)
        ]);

        $response->assertRedirect('/event/formDua');
    }

    public function test_cannot_access_without_token()
    {
        $response = $this->post('/event/formSatu', [
            'name' => 'Semarak Kemerdekaan',
            'description' => 'Valid description',
            'email' => 'anggotakwu@gmail.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2024-08-07',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertRedirect('/auth/login');
    }

    public function test_cannot_create_event_with_minimum_name()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Ab',
            'description' => 'valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertRedirect('/event/formSatu');
        $response->assertSessionHasErrors(['message' => 'Nama event minimal 3 karakter ']);
    }

    public function test_can_create_event_with_maximum_name()
    {
        $name = str_repeat('a', 255);

        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => $name,
            'description' => 'valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertRedirect('/event/formDua');
    }

    public function test_cannot_create_event_with_minimum_description()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Min desc',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertSessionHasErrors(['message' => 'Deskripsi minimal 10 karakter ']);
    }

    public function test_cannot_create_event_with_invalid_maps_link()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'Jalan Raya No 123',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertSessionHasErrors(['message' => 'Format link Google Maps tidak valid ']);
    }

    public function test_can_create_event_with_minimum_proposal_size()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 10), // 10KB
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertRedirect('/event/formDua');
    }

    public function test_can_create_event_with_maximum_proposal_size()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 20000), // 20MB
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertRedirect('/event/formDua');
    }

    public function test_cannot_create_event_with_oversized_proposal()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 21000), // 21MB
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertSessionHasErrors(['message' => 'Ukuran file proposal maksimal 20MB ']);
    }

    public function test_can_create_event_with_minimum_poster_size()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->create('poster.jpg', 10) // 10KB
        ]);

        $response->assertRedirect('/event/formDua');
    }

    public function test_can_create_event_with_maximum_poster_size()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->create('poster.jpg', 2000) // 2MB
        ]);

        $response->assertRedirect('/event/formDua');
    }

    public function test_cannot_create_event_with_oversized_poster()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->create('poster.jpg', 5000) // 3MB
        ]);

        $response->assertRedirect('/event/formSatu');
        $response->assertSessionHasErrors(['message' => 'Ukuran file poster maksimal 2MB ']);
    }

    public function test_cannot_create_event_with_past_date()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2023-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);
        $response->assertRedirect('/event/formSatu');
        $response->assertSessionHasErrors(['message' => 'Tanggal event tidak boleh di masa lalu ']);
    }

    public function test_cannot_create_event_with_empty_fields()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => '',
            'description' => '',
            'email' => '',
            'location' => '',
            'proposal' => '',
            'start_date' => '',
            'image' => ''
        ]);

        $response->assertRedirect('/event/formSatu');
        $response->assertSessionHasErrors([
            'message'
        ]);
    }

    public function test_cannot_create_event_with_invalid_file_type()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.docx', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertRedirect('/event/formSatu');
        $response->assertSessionHasErrors(['message' => 'File proposal harus berformat PDF ']);
    }

    public function test_cannot_create_event_with_invalid_image_type()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'valid@email.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->create('poster.gif', 1000)
        ]);

        $response->assertSessionHasErrors(['message' => 'File poster harus berformat JPG atau PNG ']);
    }

    public function test_cannot_create_event_with_invalid_email()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/formSatu', [
            'name' => 'Valid Name',
            'description' => 'Valid description',
            'email' => 'invalid-email',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => UploadedFile::fake()->create('proposal.pdf', 1000),
            'start_date' => '2025-01-01',
            'image' => UploadedFile::fake()->image('poster.jpg', 1000)
        ]);

        $response->assertSessionHasErrors(['message' => 'Format email tidak valid ']);
    }
}
