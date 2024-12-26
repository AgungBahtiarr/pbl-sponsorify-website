<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SendEventTest extends TestCase
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



    public function test_can_send_event_with_valid_data()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/sponsor/detail', [
            'id_event' => 1,
            'id_sponsor' => 2
        ]);

        $response->assertStatus(302);
    }


    public function test_cant_send_event_with_invalid_data()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->post('/event/sponsor/detail', [
            'id_event' => 100,
            'id_sponsor' => 200
        ]);

        $response->assertStatus(302)->assertSessionHas('error', 'Proposal gagal dikirim');
    }
}
