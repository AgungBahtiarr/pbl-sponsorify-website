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

     
        $response = $this->post('/api/login', [
            'email' => 'b@gmail.com',
            'password' => 'butterfly123'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');
    }


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


    public function sponsor_cannot_view_nonexistent_event_detail()
    {
        $nonExistentTransactionId = 9999;

        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/sponsor/detail/' . $nonExistentTransactionId);

        $response->assertViewIs('sponsor.detaileventnotfound');
    }


    public function sponsor_cannot_access_event_without_token()
    {
        $transaction = Transaction::where('id', 1)->first();
        $this->assertNotNull($transaction);

        $response = $this->get('/sponsor/detail/' . $transaction->id);

        $response->assertStatus(302);
    }


    public function sponsor_sees_error_for_invalid_token()
    {
        $transaction = Transaction::where('id', 1)->first();
        $this->assertNotNull($transaction);

        $response = $this->withCookies(['token' => 'invalid_token', 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/sponsor/detail/' . $transaction->id);

        $response->assertStatus(302);

    }


    public function sponsor_cannot_access_event_without_proper_role()
    {
        $transaction = Transaction::where('id', 1)->first();
        $this->assertNotNull($transaction);

        $response = $this->withCookies(['token' => $this->token, 'roleUser' => 'wrong_role', 'authUser' => $this->authUser])->get('/sponsor/detail/' . $transaction->id);

        $response->assertStatus(302);
    }
}
