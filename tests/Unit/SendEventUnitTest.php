<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Sponsor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SendEventUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    use RefreshDatabase;

    protected $token;
    protected $headers;
    protected $validData;
    protected $authUser;
    protected $event;
    protected $sponsor;
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');

        $response = $this->post('/api/login', [
            'email' => 'ab@gmail.com',
            'password' => 'adam1234'
        ]);

        $this->token = $response->json('token');
        $this->authUser = $response->json('user.id');
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $this->event = Event::create([
            'id_user' => $this->authUser,
            'name' => 'Semarak Kemerdekaan',
            'description' => 'Semarak kemerdekaan merupakan bisnis plan tahunan yang diadakan di poliwangi oleh UKM KWU',
            'email' => 'anggotakwu@gmail.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => "proposal/proposal.pdf",
            'start_date' => '2024-12-07',
            'venue_name' => 'Poliwangi',
            'image' => 'image/poster.jpg',
            'fund1' => '10000000',
            'slot1' => '2',
            'fund2' => '7500000',
            'slot2' => '3',
            'fund3' => '5000000',
            'slot3' => '4',
            'fund4' => '2500000',
            'slot4' => '5'
        ]);

        $this->sponsor = Sponsor::create([
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 2
        ]);
    }

    public function test_send_event_with_valid_data()
    {
        $response = $this->withHeaders($this->headers)
            ->post('/api/transaction', [
                'id_event' => $this->event->id,
                'id_sponsor' => $this->sponsor->id
            ]);

        $response->assertStatus(201);
    }
    public function test_send_event_with_invalid_data()
    {
        $response = $this->withHeaders($this->headers)
            ->post('/api/transaction', [
                'id_event' => 'id event A',
                'id_sponsor' => 'id sponsor A',
            ]);

        $response->assertStatus(404);
    }
    public function test_send_event_with_invalid_data_and_no()
    {
        $response = $this->withHeaders($this->headers)
            ->post('/api/transaction', [
                'id_event' => 'id event A',
                'id_sponsor' => 'id sponsor A',
            ]);

        $response->assertStatus(404);
    }

    public function test_send_event_with_invalid_data_and_not_registered_in_the_database()
    {
        $response = $this->withHeaders($this->headers)
            ->post('/api/transaction', [
                'id_event' => 'id event 99',
                'id_sponsor' => 'id sponsor 99',
            ]);

        $response->assertStatus(404);
    }
}
