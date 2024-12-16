<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use App\Models\BenefitLevel;
use App\Models\Transaction;
use App\Models\Sponsor;
use App\Models\Report;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class ReportSubmissionUnitTest extends TestCase
{
    use RefreshDatabase;

    protected $eventOrganizer;
    protected $sponsorUser;
    protected $event;
    protected $sponsor;
    protected $transaction;
    protected $benefitLevel;

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
            'image' => 'event.jpg',
            'venue_name' => 'Test Venue'
        ]);

        // Buat benefit level
        $this->benefitLevel = BenefitLevel::create([
            'id_event' => $this->event->id,
            'level' => 'gold',
            'slot' => 3,
            'fund' => 7500000
        ]);

        // Buat transaksi yang sudah diterima
        $this->transaction = Transaction::create([
            'id_event' => $this->event->id,
            'id_sponsor' => $this->sponsor->id,
            'id_status' => 2, // status diterima
            'id_user' => $this->eventOrganizer->id,
            'id_payment_status' => 1,
            'id_withdraw_status' => 1,
            'id_level' => $this->benefitLevel->id
        ]);

        // Set cookie untuk autentikasi sebagai event organizer
        Cookie::queue('token', 'test-token');
        Cookie::queue('roleUser', '1'); // 1 untuk event organizer
    }

    /**
     * TC-Report-01: Berhasil mengirim laporan dengan link Google Drive yang valid
     */
    #[Test]
    public function test_can_submit_report_with_valid_link()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '1'
        ])->postJson('/api/report', [
            'report' => 'https://drive.google.com/file/d/1234567890/view',
            'id_transaction' => $this->transaction->id
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Laporan berhasil dikirim'
            ]);

        $this->assertDatabaseHas('reports', [
            'id_transaction' => $this->transaction->id
        ]);
    }

    /**
     * TC-Report-02: Gagal mengirim laporan karena link invalid
     */
    #[Test]
    public function test_cannot_submit_report_with_invalid_link()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '1'
        ])->postJson('/api/report', [
            'report' => 'https://invalid-link.com/file',
            'id_transaction' => $this->transaction->id
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Link harus dari Google Drive'
            ]);
    }

    /**
     * TC-Report-03: Gagal mengirim laporan karena link kosong
     */
    #[Test]
    public function test_cannot_submit_empty_report()
    {
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '1'
        ])->postJson('/api/report', [
            'report' => '',
            'id_transaction' => $this->transaction->id
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Link laporan wajib diisi'
            ]);
    }


    /**
     * TC-Report-04: Gagal mengirim laporan karena sudah pernah mengirim sebelumnya
     */
    #[Test]
    public function test_cannot_submit_duplicate_report()
    {
        // Buat laporan pertama
        Report::create([
            'report' => 'https://drive.google.com/file/d/1234567890/view',
            'id_transaction' => $this->transaction->id
        ]);

        // Coba kirim laporan kedua
        $response = $this->withCookies([
            'token' => 'test-token',
            'roleUser' => '1'
        ])->postJson('/api/report', [
            'report' => 'https://drive.google.com/file/d/0987654321/view',
            'id_transaction' => $this->transaction->id
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Laporan sudah pernah dikirim'
            ]);
    }
}
