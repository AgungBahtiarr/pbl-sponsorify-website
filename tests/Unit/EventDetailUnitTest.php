<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventDetailUnitTest extends TestCase
{
    use RefreshDatabase;

    protected $token;
    protected $role;
    protected $authUser;



    public function setUp(): void
    {
        parent::setUp();

        // Login untuk mendapatkan token
        $response = $this->post('/api/login', [
            'email' => 'b@gmail.com',
            'password' => 'butterfly123'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');
    }

    /** @test */
    public function sponsor_can_view_event_detail()
    {
        $transaction = Transaction::where('id', 1)->first();
        $this->assertNotNull($transaction);
        $event = $transaction->event;
        $this->assertNotNull($event);
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/sponsor/detail/' . $transaction->id);


        $response->assertStatus(200);
        $response->assertSee($event->name);
    }

    /** @test */
    public function sponsor_cannot_view_nonexistent_event_detail()
    {
  
    $nonExistentTransactionId = 9999;


    $response = $this->withCookies(['token' => $this->token,'roleUser' => $this->role,'authUser' => $this->authUser])->get('/sponsor/detail/' . $nonExistentTransactionId);


    $response->assertViewIs('sponsor.detaileventnotfound');

    }
}
