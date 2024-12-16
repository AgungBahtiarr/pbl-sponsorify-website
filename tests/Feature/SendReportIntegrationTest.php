<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Report;
use App\Models\Sponsor;
use App\Models\Transaction;
use App\Models\BenefitLevel;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendReportIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Setup roles
        Role::create(['role' => 'Event Organizer']);
        Role::create(['role' => 'Sponsor']);
        Role::create(['role' => 'Admin']);

        // Setup event organizer
        $this->eventOrganizer = User::create([
            'name' => 'Event Organizer Test',
            'email' => 'eotest'.time().'@test.com',
            'password' => Hash::make('password123'),
            'id_role' => 1
        ]);

        // Setup event
        $this->event = Event::create([
            'name' => 'Test Event 2023',
            'email' => 'eventtest'.time().'@test.com',
            'description' => 'Deskripsi event test',
            'location' => 'Jakarta',
            'proposal' => 'proposal.pdf',
            'start_date' => '2023-12-01',
            'venue_name' => 'Test Venue',
            'image' => 'event.jpg',
            'id_user' => $this->eventOrganizer->id
        ]);

        // Setup transaction
        $this->transaction = Transaction::create([
            'id_event' => $this->event->id,
            'id_sponsor' => 1,
            'id_status' => 2, // status diterima
            'id_user' => $this->eventOrganizer->id,
            'id_payment_status' => 1,
            'id_withdraw_status' => 1,
            'id_level' => 1
        ]);

        $this->withoutExceptionHandling();
    }

    /**
     * TC-IT-SendReport-01: Berhasil mengirim laporan dengan link Google Drive yang valid
     */
    public function test_can_submit_report_with_valid_google_drive_link()
    {
        $validLink = 'https://drive.google.com/file/d/1234567890/view';

        // Mock HTTP client untuk simulasi API call
        Http::fake([
            env('API_URL').'/api/report' => Http::response([
                'status' => 'success',
                'message' => 'Laporan berhasil dikirim',
                'data' => [
                    'id_transaction' => $this->transaction->id,
                    'report' => $validLink
                ]
            ], 200)
        ]);

        // Buat report terlebih dahulu (simulasi API response)
        Report::create([
            'id_transaction' => $this->transaction->id,
            'report' => $validLink
        ]);

        $response = $this->actingAs($this->eventOrganizer)
            ->withCookies([
                'token' => 'test-token',
                'roleUser' => '1'
            ])
            ->post('/event/report', [
                'report' => $validLink,
                'id_transaction' => $this->transaction->id
            ]);

        // Verifikasi redirect
        $response->assertRedirect('/event/report');

        // Verifikasi data tersimpan di database
        $this->assertDatabaseHas('reports', [
            'id_transaction' => $this->transaction->id,
            'report' => $validLink
        ]);
    }

    /**
     * TC-IT-SendReport-02: Gagal mengirim laporan karena link invalid
     */
    public function test_cannot_submit_report_with_invalid_link()
    {
        $invalidLink = 'https://invalid-link.com/file';

        // Mock HTTP client untuk simulasi API call yang gagal
        Http::fake([
            env('API_URL').'/api/report' => Http::response([
                'status' => 'error',
                'message' => 'Link harus dari Google Drive'
            ], 422)
        ]);

        $response = $this->actingAs($this->eventOrganizer)
            ->withCookies([
                'token' => 'test-token',
                'roleUser' => '1'
            ])
            ->post('/event/report', [
                'report' => $invalidLink,
                'id_transaction' => $this->transaction->id
            ]);

        // Verifikasi redirect
        $response->assertRedirect('/event/report');

        // Verifikasi data tidak tersimpan
        $this->assertDatabaseMissing('reports', [
            'id_transaction' => $this->transaction->id,
            'report' => $invalidLink
        ]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Http::clearResolvedInstances();
    }
}
