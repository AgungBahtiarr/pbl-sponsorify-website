<?php

namespace Tests\Feature;

use App\Models\Sponsor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddSponsorTest extends TestCase
{

    use RefreshDatabase;

    protected $token;
    protected $headers;
    protected $role;
    protected $authUser;

    /**
     * A basic feature test example.
     */
    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $response = $this->post('/api/login', [
            'email' => 'sponsor@gmail.com',
            'password' => 'sponsor123'
        ]);
        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');
    }


    public function test_IT_TC_SP_13_verify_store_sponsor_success()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'category' => 1,
            'maxSubmissionDate' => 30,
            'image' => UploadedFile::fake()->image('image/sponsor.jpg', 1000),
            'idUser' => 2
        ];

        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/auth/sponsor', $data);


        $response->assertStatus(302)->assertRedirect('/sponsor/dashboard');
    }

    public function test_IT_TC_SP_14_verify_failed_store_sponsor()
    {
        $data = [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsormusik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'category' => 1,
            'maxSubmissionDate' => 30,
            'image' => UploadedFile::fake()->image('image/sponsor.jpg', 1000),
            'idUser' => 1
        ];

        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/auth/sponsor', $data);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('sponsors', [
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsormusik.com'
        ]);
    }
}
