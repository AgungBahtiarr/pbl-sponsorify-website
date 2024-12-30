<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ConfirmWithdrawAdminTest extends TestCase
{
    use RefreshDatabase;

    protected $token;
    protected $headers;
    protected $validData;
    protected $role;
    protected $authUser;
    protected $event;
    protected $sponsor;
    protected $transaction;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');

        $response = $this->post('/api/login', [
            'email' => 'admin@gmail.com',
            'password' => 'baik1234'
        ]);

        $this->token = $response->json('token');
        $this->authUser = $response->json('user.id');
        $this->role = $response->json('user.id_role');
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

        $this->transaction = Transaction::create([
            'id_event' => $this->event->id,
            'id_sponsor' => $this->sponsor->id,
            'id_status' => 2,
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
            'total_fund' => '500000'
        ]);
    }

    // Test untuk valid data (menggunakan mocking HTTP)
    public function test_confirm_payment_with_valid_data()
    {
        // Mock HTTP request untuk menghindari API eksternal
        Http::fake([
            env("API_URL") . '/api/admin/withdraw' => Http::response([], 200),
        ]);

        // Lakukan request
        $response = $this->withCookies([
            'token' => $this->token,
            'roleUser' => $this->role,
            'authUser' => $this->authUser,
        ])->post('/admin/withdraw', [
            'id' => $this->transaction->id,  // Gunakan ID transaksi yang valid
            'id_withdraw_status' => 3,
        ]);

        // Asersi
        $response->assertStatus(302)
                 ->assertRedirect('/admin/withdraw')
                 ->assertSessionHas('success', 'Success to confirm withdraw');
    }

    // Test untuk ID transaksi tidak valid (menggunakan mocking HTTP)
    public function test_confirm_payment_with_unknown_id_transaction()
    {
        // Mock HTTP request untuk menghindari API eksternal
        Http::fake([
            env("API_URL") . '/api/admin/withdraw' => Http::response([], 404),
        ]);

        // Lakukan request dengan ID yang tidak valid
        $response = $this->withCookies([
            'token' => $this->token,
            'roleUser' => $this->role,
            'authUser' => $this->authUser,
        ])->post('/admin/withdraw', [
            'id' => 'invalid-id',  // ID tidak valid
            'id_withdraw_status' => 3,
        ]);

        // Asersi
        $response->assertStatus(302)
                 ->assertRedirect('/admin/withdraw')
                 ->assertSessionHas('error', 'Failed to confirm withdraw');
    }
}
