<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AddEventBenefitTest extends TestCase
{
    use RefreshDatabase;

    protected $token;
    protected $headers;
    protected $role;
    protected $authUser;
    protected $cookieSet;


    protected function setUp(): void
    {
        parent::setUp();

        $response = $this->post('/api/login', [
            'email' => 'agung@gmail.com',
            'password' => 'sandi123'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');

        $this->cookieSet = ['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser];

        $formSatu = [
            'name' => 'Test Event',
            'description' => 'Test Description',
            'email' => 'agung@gmail.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => 'proposal/proposal.pdf',
            'start_date' => '2024-12-07',
            'image' => 'image/poster.jpg',
            'id_user' => $this->authUser

        ];

        Session::put('formSatu', $formSatu);
    }

    public function test_can_add_benefit_with_valid_data()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role])->post('/event/formDua', [
            'fund1' => '10000000',
            'slot1' => '2',
            'fund2' => '7500000',
            'slot2' => '3',
            'fund3' => '5000000',
            'slot3' => '4',
            'fund4' => '2500000',
            'slot4' => '5'
        ]);
        $response->assertRedirect('/event/my_event')->assertSessionHas('success', 'Event berhasil dibuat');
    }

    public function test_cannot_add_benefit_with_empty_fund()
    {
        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => '',
            'slot1' => '2',
            'fund2' => '',
            'slot2' => '3',
            'fund3' => '',
            'slot3' => '4',
            'fund4' => '',
            'slot4' => '5'
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Total pendanaan Platinum wajib diisi Total pendanaan Gold wajib diisi Total pendanaan Silver wajib diisi Total pendanaan Bronze wajib diisi '
        ]);
    }

    public function test_cannot_add_benefit_with_empty_slots()
    {
        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => '10000000',
            'slot1' => '',
            'fund2' => '7500000',
            'slot2' => '',
            'fund3' => '5000000',
            'slot3' => '',
            'fund4' => '2500000',
            'slot4' => ''
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Jumlah slot Platinum wajib diisi Jumlah slot Gold wajib diisi Jumlah slot Silver wajib diisi Jumlah slot Bronze wajib diisi '
        ]);
    }

    public function test_cannot_add_benefit_with_zero_slots()
    {
        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => '10000000',
            'slot1' => '0',
            'fund2' => '7500000',
            'slot2' => '0',
            'fund3' => '5000000',
            'slot3' => '0',
            'fund4' => '2500000',
            'slot4' => '0'
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Jumlah slot Platinum minimal 1 Jumlah slot Gold minimal 1 Jumlah slot Silver minimal 1 Jumlah slot Bronze minimal 1 '
        ]);
    }

    public function test_cannot_add_benefit_with_negative_fund()
    {
        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => '-10000000',
            'slot1' => '2',
            'fund2' => '-7500000',
            'slot2' => '3',
            'fund3' => '-5000000',
            'slot3' => '4',
            'fund4' => '-2500000',
            'slot4' => '5'
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Total pendanaan Platinum minimal Rp. 100.000 Total pendanaan Gold minimal Rp. 100.000 Total pendanaan Silver minimal Rp. 100.000 Total pendanaan Bronze minimal Rp. 100.000 '
        ]);
    }

    public function test_cannot_add_benefit_with_negative_slots()
    {
        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => '10000000',
            'slot1' => '-2',
            'fund2' => '7500000',
            'slot2' => '-3',
            'fund3' => '5000000',
            'slot3' => '-4',
            'fund4' => '2500000',
            'slot4' => '-5'
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Jumlah slot Platinum minimal 1 Jumlah slot Gold minimal 1 Jumlah slot Silver minimal 1 Jumlah slot Bronze minimal 1 '
        ]);
    }

    public function test_cannot_add_benefit_with_decimal_slots()
    {
        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => '10000000',
            'slot1' => '2.5',
            'fund2' => '7500000',
            'slot2' => '3.5',
            'fund3' => '5000000',
            'slot3' => '4.5',
            'fund4' => '2500000',
            'slot4' => '5.5'
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Jumlah slot Platinum harus berupa angka bulat Jumlah slot Gold harus berupa angka bulat Jumlah slot Silver harus berupa angka bulat Jumlah slot Bronze harus berupa angka bulat '
        ]);
    }

    public function test_cannot_add_benefit_without_form_satu()
    {
        // Clear session
        Session::forget('formSatu');

        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => '10000000',
            'slot1' => '2',
            'fund2' => '7500000',
            'slot2' => '3',
            'fund3' => '5000000',
            'slot3' => '4',
            'fund4' => '2500000',
            'slot4' => '5'
        ]);

        $response->assertRedirect('/event/formSatu')
            ->assertSessionMissing('formSatu');
    }

    public function test_cannot_add_benefit_with_all_empty_fields()
    {
        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => '',
            'slot1' => '',
            'fund2' => '',
            'slot2' => '',
            'fund3' => '',
            'slot3' => '',
            'fund4' => '',
            'slot4' => ''
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Total pendanaan Platinum wajib diisi Total pendanaan Gold wajib diisi Total pendanaan Silver wajib diisi Total pendanaan Bronze wajib diisi Jumlah slot Platinum wajib diisi Jumlah slot Gold wajib diisi Jumlah slot Silver wajib diisi Jumlah slot Bronze wajib diisi '
        ]);
    }

    public function test_cannot_add_benefit_with_non_numeric_fund()
    {
        $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
            'fund1' => 'abc',
            'slot1' => '2',
            'fund2' => 'def',
            'slot2' => '3',
            'fund3' => 'ghi',
            'slot3' => '4',
            'fund4' => 'jkl',
            'slot4' => '5'
        ]);

        $response->assertSessionHasErrors([
            'message' => 'Total pendanaan Platinum harus berupa angka Total pendanaan Platinum minimal Rp. 100.000 Total pendanaan Gold harus berupa angka Total pendanaan Gold minimal Rp. 100.000 Total pendanaan Silver harus berupa angka Total pendanaan Silver minimal Rp. 100.000 Total pendanaan Bronze harus berupa angka Total pendanaan Bronze minimal Rp. 100.000 '
        ]);
    }

    // Test API Integration
    // public function test_api_integration_success()
    // {
    //     Http::fake([
    //         'http://localhost:8080/api/event' => Http::response(['status' => 'success'], 200)
    //     ]);

    //     $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
    //         'fund1' => '10000000',
    //         'slot1' => '2',
    //         'fund2' => '7500000',
    //         'slot2' => '3',
    //         'fund3' => '5000000',
    //         'slot3' => '4',
    //         'fund4' => '2500000',
    //         'slot4' => '5'
    //     ]);

    //     $response->assertRedirect('/event/my_event');
    // }

    // public function test_api_integration_failure()
    // {
    //     Http::fake([
    //         'http://localhost:8080/api/event' => Http::response(['error' => 'Server error'], 500)
    //     ]);

    //     $response = $this->withCookies($this->cookieSet)->post('/event/formDua', [
    //         'fund1' => '10000000',
    //         'slot1' => '2',
    //         'fund2' => '7500000',
    //         'slot2' => '3',
    //         'fund3' => '5000000',
    //         'slot3' => '4',
    //         'fund4' => '2500000',
    //         'slot4' => '5'
    //     ]);

    //     $response->assertRedirect()->assertSessionHas('error');
    // }
}
