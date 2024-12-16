<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\Transaction;
use App\Models\Event;
use App\Models\Sponsor;
use App\Models\Status;
use App\Models\WithdrawStatus;
use App\Models\PaymentStatus;
use App\Models\BenefitLevel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class WithdrawPaymentUnitTest extends TestCase
{
    use RefreshDatabase;

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
        $user = User::create([
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
            'id_user' => $user->id
        ]);

        // Create sponsor
        $sponsor = Sponsor::create([
            'name' => 'Test Sponsor',
            'email' => 'test@sponsor.com',
            'description' => 'Test Description',
            'address' => 'Test Address',
            'image' => 'test.jpg',
            'id_category' => 1,
            'id_user' => $user->id,
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
            'id_user' => $user->id,
            'id_level' => $benefitLevel->id
        ]);
    }

    #[Test]
    public function test_can_submit_valid_data()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Berhasil menyimpan data pencairan'
            ]);

        $this->assertDatabaseHas('transactions', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => 'John Doe'
        ]);
    }

    #[Test]
    public function test_account_number_minimum_length()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '123456789',
            'bank_name' => 'BCA',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Nomor rekening minimal 10 karakter'
            ]);
    }

    #[Test]
    public function test_account_number_exact_ten_characters()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
    }

    #[Test]
    public function test_account_number_exact_fifteen_characters()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '123456789012345',
            'bank_name' => 'BCA',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
    }

    #[Test]
    public function test_account_number_maximum_length()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890123456',
            'bank_name' => 'BCA',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Nomor rekening maksimal 15 karakter'
            ]);
    }

    #[Test]
    public function test_bank_name_minimum_length()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BC',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Nama bank minimal 3 karakter'
            ]);
    }

    #[Test]
    public function test_bank_name_exact_three_characters()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
    }

    #[Test]
    public function test_bank_name_exact_twenty_characters()
    {


        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BANK SYARIAH INDO',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
    }

    #[Test]
    public function test_bank_name_maximum_length()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'Bank Central Asia BCAs',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Nama bank maksimal 20 karakter'
            ]);
    }

    #[Test]
    public function test_account_name_minimum_length()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => 'Jo',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Nama pengguna minimal 3 karakter'
            ]);
    }

    #[Test]
    public function test_account_name_exact_three_characters()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => 'Joe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
    }

    #[Test]
    public function test_account_name_exact_fifty_characters()
    {
        $exact50Chars = str_pad('', 50, 'A');

        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => $exact50Chars,
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ]);
    }

    #[Test]
    public function test_account_name_maximum_length()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'BCA',
            'account_name' => str_pad('', 51, 'A'), // 51 karakter
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Nama pengguna maksimal 50 karakter'
            ]);
    }

    #[Test]
    public function test_all_fields_empty()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '',
            'bank_name' => '',
            'account_name' => '',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Semua field wajib diisi'
            ]);
    }

    #[Test]
    public function test_unregistered_bank()
    {
        $response = $this->postJson('/api/withdraw', [
            'id' => $this->transaction->id,
            'no_rek' => '1234567890',
            'bank_name' => 'ABC Bank',
            'account_name' => 'John Doe',
            'id_withdraw_status' => 2
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Bank tidak terdaftar'
            ]);
    }
}
