<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ConfirmPaymentAdminUnitTest extends TestCase
{
    use RefreshDatabase;

    protected $token;
    protected $headers;
    protected $authUser;
    protected $event;
    protected $sponsor;
    protected $transaction;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');

        // Login untuk mendapatkan token
        $response = $this->post('/api/login', [
            'email' => 'ab@gmail.com',
            'password' => 'adam1234',
        ]);

        $this->token = $response->json('token');
        $this->authUser = $response->json('user.id');
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,
        ];

        // Buat data event, sponsor, dan transaksi
        $this->event = Event::create([
            'id_user' => $this->authUser,
            'name' => 'Semarak Kemerdekaan',
            'description' => 'Semarak kemerdekaan merupakan bisnis plan tahunan yang diadakan di poliwangi oleh UKM KWU',
            'email' => 'anggotakwu@gmail.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => 'proposal/proposal.pdf',
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
            'slot4' => '5',
        ]);

        $this->sponsor = Sponsor::create([
            'name' => 'Sponsor Event Musik',
            'email' => 'sponsor@musik.com',
            'description' => 'Sponsor untuk event musik',
            'address' => 'Jl. Musik No.1',
            'id_category' => 1,
            'max_submission_date' => 30,
            'image' => 'image.jpg',
            'id_user' => 2,
        ]);

        $this->transaction = Transaction::create([
            'id_event' => $this->event->id,
            'id_sponsor' => $this->sponsor->id,
            'id_status' => 1,
            'id_user' => $this->authUser,
            'id_level' => 1,
            'comment' => 'semoga eventnya sukses ya',
            'no_rek' => '08942288383',
            'bank_name' => 'bni',
            'account_name' => 'falen',
            'id_payment_status' => 2,
            'id_withdraw_status' => 1,
            'payment_date' => '2024-04-05',
            'withdraw_date' => null,
            'total_fund' => '500000',
        ]);
    }

    public function test_confirm_payment_with_valid_data()
    {
        $response = $this->post('/api/admin/payment', [
            'id' => $this->transaction->id,
            'id_payment_status' => 3,
        ], $this->headers);

        $response->assertStatus(200)->assertJsonFragment([
            'id_payment_status' => 3,
        ]);
    }

    public function test_confirm_payment_with_unknown_id_transaction()
    {
        $response = $this->post('/api/admin/payment', [
            'id' => 99999,
            'id_payment_status' => 3,
        ], $this->headers);

        $response->assertStatus(404)->assertJsonFragment([
            'error' => 'Transaction not found',
        ]);
    }

    public function test_confirm_payment_already_completed()
    {
        $this->transaction->update(['id_payment_status' => 3]);

        $response = $this->post('/api/admin/payment', [
            'id' => $this->transaction->id,
            'id_payment_status' => 3,
        ], $this->headers);

        $response->assertStatus(400)->assertJsonFragment([
            'error' => 'Payment already confirmed',
        ]);
    }

    public function test_confirm_payment_with_empty_input()
    {
        $response = $this->post('/api/admin/payment', [], $this->headers);

        $response->assertStatus(422)->assertJsonValidationErrors(['id', 'id_payment_status']);
    }

    public function test_general_confirm_payment()
    {
        $response = $this->post('/api/admin/payment', [
            'id' => $this->transaction->id,
            'id_payment_status' => 3,
        ], $this->headers);

        $response->assertStatus(200)->assertJsonFragment([
            'id_payment_status' => 3,
            'message' => 'Payment confirmed successfully',
        ]);
    }
}
