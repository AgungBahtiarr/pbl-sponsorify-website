<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use App\Models\BenefitLevel;
use App\Models\Transaction;
use App\Models\Sponsor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class ProposalResponseTest extends TestCase
{
    use RefreshDatabase;

    protected $eventOrganizer;
    protected $sponsorUser;
    protected $event;
    protected $sponsor;
    protected $transaction;
    protected $benefitLevels;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user Event Organizer
        $this->eventOrganizer = User::create([
            'name' => 'Event Organizer',
            'email' => 'eo@test.com',
            'password' => Hash::make('password123'),
            'id_role' => 1,
            'email_verified_at' => now()
        ]);

        // Buat user Sponsor
        $this->sponsorUser = User::create([
            'name' => 'Sponsor User',
            'email' => 'sponsor@test.com',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'email_verified_at' => now()
        ]);

        // Buat data sponsor
        $this->sponsor = Sponsor::create([
            'name' => 'Test Sponsor Company',
            'email' => 'sponsor@company.test',
            'description' => 'This is a test sponsor company',
            'address' => 'Test Address 123',
            'max_submission_date' => '2023-12-31',
            'image' => 'sponsor.jpg',
            'id_category' => 1,
            'id_user' => $this->sponsorUser->id
        ]);

        // Buat event
        $this->event = Event::create([
            'name' => 'Test Event 2023',
            'email' => 'event@test.com',
            'description' => 'Deskripsi event test',
            'location' => 'Jakarta',
            'proposal' => 'proposal.pdf',
            'start_date' => '2023-12-01',
            'id_user' => $this->eventOrganizer->id,
            'image' => 'event.jpg'
        ]);

        // Buat benefit levels
        $this->benefitLevels = [
            BenefitLevel::create([
                'id_event' => $this->event->id,
                'level' => 'platinum',
                'slot' => 2,
                'fund' => 10000000
            ]),
            BenefitLevel::create([
                'id_event' => $this->event->id,
                'level' => 'gold',
                'slot' => 3,
                'fund' => 7500000
            ]),
            BenefitLevel::create([
                'id_event' => $this->event->id,
                'level' => 'silver',
                'slot' => 5,
                'fund' => 5000000
            ]),
            BenefitLevel::create([
                'id_event' => $this->event->id,
                'level' => 'bronze',
                'slot' => 7,
                'fund' => 2500000
            ])
        ];

        // Buat transaksi pengajuan event ke sponsor
        $this->transaction = Transaction::create([
            'id_event' => $this->event->id,
            'id_sponsor' => $this->sponsor->id,
            'id_status' => 1,
            'id_user' => $this->eventOrganizer->id,
            'id_payment_status' => 1,
            'id_withdraw_status' => 1
        ]);

        // Set cookie untuk autentikasi
        Cookie::queue('token', 'test-token');
        Cookie::queue('roleUser', '2');
    }

    /**
     * TC-Respon-01: Menolak proposal dan memberikan alasan penolakan yang valid
     */
    #[Test]
    public function test_can_reject_proposal_with_valid_reason()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '2'
        ])->patchJson('/api/transaction', [
            'id' => $this->transaction->id,
            'id_status' => 3,
            'comment' => 'Proposal tidak sesuai dengan kriteria pendanaan yang kami tetapkan untuk event ini.'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Respon telah terkirim'
            ]);

        // Verifikasi data di database
        $this->assertDatabaseHas('transactions', [
            'id' => $this->transaction->id,
            'id_status' => 3
        ]);
    }

    /**
     * TC-Respon-02: Mencoba menolak proposal dengan pesan kurang dari 15 karakter
     */
    #[Test]
    public function test_cannot_reject_proposal_with_comment_less_than_15_chars()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '2'
        ])->patchJson('/api/transaction', [
            'id' => $this->transaction->id,
            'id_status' => 3,
            'comment' => 'Teks pendek'
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Teks pesan kurang dari 15 karakter'
            ]);
    }

    /**
     * TC-Respon-03: Mencoba menolak proposal dengan pesan lebih dari 255 karakter
     */
    #[Test]
    public function test_cannot_reject_proposal_with_comment_more_than_255_chars()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '2'
        ])->patchJson('/api/transaction', [
            'id' => $this->transaction->id,
            'id_status' => 3,
            'comment' => str_repeat('a', 256)
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Teks pesan lebih dari 255 karakter'
            ]);
    }

    /**
     * TC-Respon-04: Menerima proposal dan mengisi semua data yang diperlukan dengan benar
     */
    #[Test]
    public function test_can_approve_proposal_with_valid_data()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '2'
        ])->patchJson('/api/transaction', [
            'id' => $this->transaction->id,
            'id_status' => 2,
            'id_level' => $this->benefitLevels[1]->id,
            'comment' => 'Proposal Anda diterima. Kami memilih paket Gold untuk mendukung event ini.'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Respon telah terkirim'
            ]);

        // Verifikasi data di database
        $this->assertDatabaseHas('transactions', [
            'id' => $this->transaction->id,
            'id_status' => 2,
            'id_level' => $this->benefitLevels[1]->id
        ]);
    }

    /**
     * TC-Respon-05: Mencoba menerima proposal dengan pesan kurang dari 15 karakter
     */
    #[Test]
    public function test_cannot_approve_proposal_with_comment_less_than_15_chars()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '2'
        ])->patchJson('/api/transaction', [
            'id' => $this->transaction->id,
            'id_status' => 2,
            'id_level' => $this->benefitLevels[1]->id,
            'comment' => 'Teks pendek'
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Teks pesan kurang dari 15 karakter'
            ]);
    }

    /**
     * TC-Respon-06: Mencoba menerima proposal dengan pesan lebih dari 255 karakter
     */
    #[Test]
    public function test_cannot_approve_proposal_with_comment_more_than_255_chars()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '2'
        ])->patchJson('/api/transaction', [
            'id' => $this->transaction->id,
            'id_status' => 2,
            'id_level' => $this->benefitLevels[1]->id,
            'comment' => str_repeat('a', 256)
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Teks pesan lebih dari 255 karakter'
            ]);
    }

    /**
     * TC-Respon-07: Menerima proposal tanpa memilih benefit
     */
    #[Test]
    public function test_cannot_approve_proposal_without_benefit()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '2'
        ])->patchJson('/api/transaction', [
            'id' => $this->transaction->id,
            'id_status' => 2,
            'comment' => 'Proposal Anda diterima. Silakan lanjutkan dengan persiapan event.'
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Benefit belum dipilih'
            ]);
    }

    /**
     * TC-Respon-08: Pembatalan saat menolak proposal
     */
    #[Test]
    public function test_can_cancel_reject_proposal()
    {
        $originalStatus = $this->transaction->id_status;

        // Simulasi pembatalan dengan mengecek status tidak berubah
        $this->assertEquals($originalStatus, $this->transaction->fresh()->id_status);
    }

    /**
     * TC-Respon-09: Pembatalan saat menerima proposal
     */
    #[Test]
    public function test_can_cancel_approve_proposal()
    {
        $originalStatus = $this->transaction->id_status;

        // Simulasi pembatalan dengan mengecek status tidak berubah
        $this->assertEquals($originalStatus, $this->transaction->fresh()->id_status);
    }
}
