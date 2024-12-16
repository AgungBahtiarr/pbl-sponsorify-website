<?php

namespace Tests\Unit;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class ConfirmPaymentAdminUnitTest extends TestCase
{
    use RefreshDatabase; // Untuk refresh database pada setiap tes

    /**
     * Test untuk mengonfirmasi pembayaran pada model Transaction
     *
     * @return void
     */

     protected function setUp(): void{
        parent::setUp();
     }
    public function test_confirm_payment_update_status()
    {
        $response = $this->post('/api/admin/payment',data: [
            'id' => '1',
            'id_payment_status' => 3,
        ]);     
        
        $response->assertStatus(200)->assertJsonFragment([
            'id_payment_status' => 3,
        ]);
    }
}
