<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class EventDetailTest extends TestCase
{
    protected $token;
    protected $role;
    protected $authUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Login untuk mendapatkan token
        $response = $this->post('/api/login', [
            'email' => 'b@gmail.com',
            'password' => 'butterfly123'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');


    }

    /** @test */
    public function sponsor_can_view_event_detail()
    {
        // Ambil transaksi pertama untuk user yang login
        $transaction = Transaction::where('id', 1)->first();

        // Pastikan transaksi ditemukan
        $this->assertNotNull($transaction);

        // Ambil event berdasarkan transaksi
        $event = $transaction->event;

        // Pastikan event ditemukan
        $this->assertNotNull($event);

        // Kirim request untuk melihat detail event
        $response = $this->withCookies([
            'token' => $this->token,
            'roleUser' => $this->role,
            'authUser' => $this->authUser
        ])->get('/sponsor/detail/' . $transaction->id);

        // Periksa status respons
        $response->assertStatus(200);

        // Pastikan data event muncul di halaman detail
        $response->assertSee($event->name);
        $response->assertSee(date('d/m/Y', strtotime($event->start_date)));
        $response->assertSee($event->address);
        $response->assertSee($event->responsible_person);
    }

    /** @test */
public function sponsor_cannot_view_nonexistent_event_detail()
{
    // ID transaksi yang tidak ada di database
    $nonExistentTransactionId = 9999;

    // Kirim request untuk melihat detail event dengan ID yang tidak ada
    $response = $this->withCookies([
        'token' => $this->token,
        'roleUser' => $this->role,
        'authUser' => $this->authUser
    ])->get('/sponsor/detail/' . $nonExistentTransactionId);


    // Pastikan view yang ditampilkan adalah detaileventnotfound
    $response->assertViewIs('sponsor.detaileventnotfound');

    // Pastikan pesan yang ditampilkan pada halaman not found sesuai
    $response->assertSee('Detail Event Tidak Ditemukan');
}

}
