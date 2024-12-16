<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ConfirmPaymentAdminTest extends TestCase
{
    use RefreshDatabase;  // Untuk melakukan refresh database di setiap test

    /**
     * Test untuk mengonfirmasi pembayaran
     *
     * @return void
     */
    public function test_confirm_payment_admin()
    {
        // 1. Menyiapkan data transaksi
        $transaction = Transaction::factory()->create([
            'id_payment_status' => 1,  // Status pembayaran sebelum update
        ]);

        // 2. Data request untuk konfirmasi pembayaran
        $data = [
            'id' => $transaction->id,  // ID transaksi yang akan diperbarui
            'id_payment_status' => 2,  // Status pembayaran setelah dikonfirmasi (misalnya: 2 = "Selesai")
        ];

        // 3. Melakukan request POST ke endpoint confirmPaymentAdmin
        $response = $this->postJson(route('api.confirmPaymentAdmin'), $data);

        // 4. Memastikan status HTTP response adalah 200 OK
        $response->assertStatus(Response::HTTP_OK);

        // 5. Memastikan bahwa transaksi diperbarui dengan benar
        $response->assertJsonFragment([
            'id' => $transaction->id,
            'id_payment_status' => 2,  // Status harus diperbarui menjadi 2
        ]);

        // 6. Memastikan bahwa field 'payment_date' terisi (bukan null)
        $this->assertNotNull($response->json()['payment_date']);
    }
}
