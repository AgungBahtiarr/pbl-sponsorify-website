<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Transaction;
use App\Models\Status;
use App\Models\WithdrawStatus;
use App\Models\PaymentStatus;
use App\Models\BenefitLevel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class WithdrawPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $transaction;

    protected function setUp(): void
    {
        parent::setUp();

        // Create necessary roles and statuses
        Status::create(['status' => 'Sedang diproses']);
        Status::create(['status' => 'Diterima']);
        Status::create(['status' => 'Ditolak']);

        PaymentStatus::create(['status' => 'Belum Dibayar']);
        PaymentStatus::create(['status' => 'Menunggu Verifikasi']);
        PaymentStatus::create(['status' => 'Berhasil']);

        WithdrawStatus::create(['status' => 'Belum Dicairkan']);
        WithdrawStatus::create(['status' => 'Sedang Diproses']);
        WithdrawStatus::create(['status' => 'Selesai']);

        // Create user
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'id_role' => 1
        ]);

        // Create event
        $event = Event::create([
            'name' => 'Test Event',
            'email' => 'test@event.com',
            'description' => 'Test Description',
            'location' => 'Test Location',
            'proposal' => 'test.pdf',
            'start_date' => '2024-01-01',
            'venue_name' => 'Test Venue',
            'image' => 'test.jpg',
            'id_user' => $this->user->id
        ]);

        // Create sponsor
        $sponsor = Sponsor::create([
            'name' => 'Test Sponsor',
            'email' => 'test@sponsor.com',
            'description' => 'Test Description',
            'address' => 'Test Address',
            'image' => 'test.jpg',
            'id_category' => 1,
            'id_user' => $this->user->id,
            'max_submission_date' => '30 Hari'
        ]);

        // Create benefit level
        $benefitLevel = BenefitLevel::create([
            'id_event' => $event->id,
            'level' => 'gold',
            'slot' => 3,
            'fund' => 700000
        ]);

        // Create transaction
        $this->transaction = Transaction::create([
            'id_event' => $event->id,
            'id_sponsor' => $sponsor->id,
            'id_status' => 2,
            'id_payment_status' => 3,
            'id_withdraw_status' => 1,
            'id_user' => $this->user->id,
            'id_level' => $benefitLevel->id
        ]);
    }

    /**
     * IT-payment-01: Input Valid Data
     * Test case untuk memverifikasi input data valid
     */
    #[Test]
    public function test_submit_valid_withdrawal_data()
    {
        // Login sebagai event organizer
        $this->actingAs($this->user);

        // Set cookie yang diperlukan
        $cookie = cookie('token', 'test-token');
        $roleCookie = cookie('roleUser', '1');

        // Mock HTTP response untuk data valid
        Http::fake([
            env('API_URL').'/api/withdraw' => Http::response([
                'status' => 'success',
                'message' => 'Berhasil menyimpan data pencairan'
            ], 200)
        ]);

        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '1'
        ])->post('/event/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        // Verifikasi redirect ke halaman yang benar
        $response->assertRedirect('/event/withdraw');
    }

    /**
     * IT-payment-02: Input Data tidak Valid
     * Test case untuk memverifikasi input data tidak valid
     */
    #[Test]
    public function test_submit_invalid_withdrawal_data()
    {
        // Login sebagai event organizer
        $this->actingAs($this->user);

        // Mock HTTP response untuk data tidak valid
        Http::fake([
            env('API_URL').'/api/withdraw' => Http::response([
                'status' => 'error',
                'message' => 'Nama bank minimal 3 karakter'
            ], 422)
        ]);

        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '1'
        ])->post('/event/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BC',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        // Verifikasi redirect ke halaman yang benar
        $response->assertRedirect('/event/withdraw');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Http::clearResolvedInstances();
    }
}
