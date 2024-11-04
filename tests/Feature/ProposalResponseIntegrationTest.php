<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ProposalResponseIntegrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::fake();
        $this->withoutMiddleware();
    }

    /**
     * TC-IT-Respon-01: Menerima proposal dengan data lengkap
     */
    public function test_accept_proposal_with_valid_data()
    {
        Http::fake([
            'http://localhost:8080/api/transaction' => Http::response([
                'status' => 'success',
                'message' => 'Respon telah terkirim'
            ], 200)
        ]);

        $response = $this->patch('/sponsor/review', [
            'id' => 1,
            'id_status' => 2, // status terima
            'id_level' => 1, // benefit level
            'comment' => 'Proposal Anda diterima. Silakan lanjutkan dengan persiapan event.'
        ]);

        $response->assertRedirect('/sponsor/payment');
        $response->assertSessionHas('success', 'Respon telah terkirim');

        Http::assertSent(function ($request) {
            return $request->url() == 'http://localhost:8080/api/transaction' &&
                   $request->method() == 'PATCH' &&
                   $request['id_status'] == 2 &&
                   $request['id_level'] == 1 &&
                   strlen($request['comment']) >= 15;
        });
    }

    /**
     * TC-IT-Respon-02: Menerima proposal dengan pesan pendek
     */
    public function test_cannot_accept_proposal_with_short_message()
    {
        $response = $this->patch('/sponsor/review', [
            'id' => 1,
            'id_status' => 2,
            'id_level' => 1,
            'comment' => '14 char msg...' // 14 karakter
        ]);

        $response->assertRedirect('/event/detail');
        $response->assertSessionHas('error', 'Teks pesan kurang dari 15 karakter');
    }

    /**
     * TC-IT-Respon-03: Menolak proposal dengan pesan pendek
     */
    public function test_cannot_reject_proposal_with_short_message()
    {
        $response = $this->patch('/sponsor/review', [
            'id' => 1,
            'id_status' => 3, // status tolak
            'comment' => '14 char msg...' // 14 karakter
        ]);

        $response->assertRedirect('/event/detail');
        $response->assertSessionHas('error', 'Teks pesan kurang dari 15 karakter');
    }

    /**
     * TC-IT-Respon-04: Menolak proposal dengan alasan valid
     */
    public function test_reject_proposal_with_valid_reason()
    {
        Http::fake([
            'http://localhost:8080/api/transaction' => Http::response([
                'status' => 'success',
                'message' => 'Respon telah terkirim'
            ], 200)
        ]);

        $response = $this->patch('/sponsor/review', [
            'id' => 1,
            'id_status' => 3,
            'comment' => 'Proposal tidak sesuai dengan kriteria pendanaan'
        ]);

        $response->assertRedirect('/event/detail');
        $response->assertSessionHas('success', 'Respon telah terkirim'); // Memperbaiki typo di sini

        Http::assertSent(function ($request) {
            return $request->url() == 'http://localhost:8080/api/transaction' &&
                   $request->method() == 'PATCH' &&
                   $request['id_status'] == 3 &&
                   strlen($request['comment']) >= 15;
        });
    }
}
