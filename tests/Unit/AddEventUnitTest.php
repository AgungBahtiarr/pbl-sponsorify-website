<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddEventUnitTest extends TestCase
{
    use RefreshDatabase;

    protected $token;
    protected $headers;
    protected $validData;
    protected $authUser;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');

        $response = $this->post('/api/login', [
            'email' => 'agung@gmail.com',
            'password' => 'sandi123'
        ]);

        $this->token = $response->json('token');
        $this->authUser = $response->json('user.id');
        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,
        ];


        $this->validData = [
            'id_user' => $this->authUser,
            'name' => 'Semarak Kemerdekaan',
            'description' => 'Semarak kemerdekaan merupakan bisnis plan tahunan yang diadakan di poliwangi oleh UKM KWU',
            'email' => 'anggotakwu@gmail.com',
            'location' => 'https://maps.app.goo.gl/kroonKXRdun2SfWo7',
            'proposal' => "proposal/proposal.pdf",
            'start_date' => '2024-12-07',
            'image' => 'image/poster.jpg',
            'fund1' => '10000000',
            'slot1' => '2',
            'fund2' => '7500000',
            'slot2' => '3',
            'fund3' => '5000000',
            'slot3' => '4',
            'fund4' => '2500000',
            'slot4' => '5'
        ];
    }

    public function test_can_create_event_with_valid_data()
    {
        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $this->validData);

        // dd($response);
        $response->assertStatus(
            201
        );
    }

    public function test_cannot_access_without_token()
    {
        $response = $this->post('/api/event', $this->validData);

        $response->assertStatus(403);
    }

    public function test_cannot_create_event_with_minimum_name()
    {
        $data = array_merge($this->validData, ['name' => 'Ab']);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'name' => ['Nama event minimal 3 karakter']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_minimum_description()
    {
        $data = array_merge($this->validData, ['description' => 'Min desc']);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'description' => ['Deskripsi minimal 10 karakter']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_invalid_maps_link()
    {
        $data = array_merge($this->validData, ['location' => 'Jalan Raya No 123']);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'location' => ['Lokasi harus berupa link Google Maps yang valid']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_past_date()
    {
        $data = array_merge($this->validData, ['start_date' => '2023-01-01']);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'start_date' => ['Tanggal event harus setelah hari ini']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_invalid_benefit_fund()
    {
        $data = array_merge($this->validData, ['fund1' => '-1000']);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'fund1' => ['Total pendanaan minimal 1']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_invalid_benefit_slot()
    {
        $data = array_merge($this->validData, ['slot1' => '0']);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'slot1' => ['Jumlah slot minimal 1']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_empty_fields()
    {
        $emptyData = [
            'name' => '',
            'description' => '',
            'email' => '',
            'location' => '',
            'proposal' => '',
            'start_date' => '',
            'image' => '',
            'fund1' => '',
            'slot1' => '',
            'fund2' => '',
            'slot2' => '',
            'fund3' => '',
            'slot3' => '',
            'fund4' => '',
            'slot4' => ''
        ];

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $emptyData);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'description' => ['Deskripsi event wajib diisi'],
                'email' => ['Email PIC wajib diisi'],
                'fund1' => ['Total pendanaan Platinum wajib diisi'],
                'fund2' => ['Total pendanaan Gold wajib diisi'],
                'fund3' => ['Total pendanaan Silver wajib diisi'],
                'fund4' => ['Total pendanaan Bronze wajib diisi'],
                'id_user' => ['The id user field is required.'],
                'image' => ['Poster event wajib diupload'],
                'location' => ['Lokasi event wajib diisi'],
                'name' => ['Nama event wajib diisi'],
                'proposal' => ['Proposal event wajib diupload'],
                'slot1' => ['Jumlah slot Platinum wajib diisi'],
                'slot2' => ['Jumlah slot Gold wajib diisi'],
                'slot3' => ['Jumlah slot Silver wajib diisi'],
                'slot4' => ['Jumlah slot Bronze wajib diisi'],
                'start_date' => ['Tanggal mulai event wajib diisi']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }


    public function test_cannot_create_event_with_invalid_email()
    {
        $data = array_merge($this->validData, ['email' => 'invalid-email']);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'email' => ['Format email tidak valid']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_can_create_event_with_minimum_fund()
    {
        $data = array_merge($this->validData, [
            'fund1' => '1',
            'fund2' => '1',
            'fund3' => '1',
            'fund4' => '1'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(201);
    }

    public function test_cannot_create_event_with_zero_fund()
    {
        $data = array_merge($this->validData, [
            'fund1' => '0',
            'fund2' => '0',
            'fund3' => '0',
            'fund4' => '0'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'fund1' => ['Total pendanaan minimal 1'],
                'fund2' => ['Total pendanaan minimal 1'],
                'fund3' => ['Total pendanaan minimal 1'],
                'fund4' => ['Total pendanaan minimal 1']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_negative_fund()
    {
        $data = array_merge($this->validData, [
            'fund1' => '-1000',
            'fund2' => '-1000',
            'fund3' => '-1000',
            'fund4' => '-1000'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'fund1' => ['Total pendanaan minimal 1'],
                'fund2' => ['Total pendanaan minimal 1'],
                'fund3' => ['Total pendanaan minimal 1'],
                'fund4' => ['Total pendanaan minimal 1']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_can_create_event_with_minimum_slot()
    {
        $data = array_merge($this->validData, [
            'slot1' => '1',
            'slot2' => '1',
            'slot3' => '1',
            'slot4' => '1'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);


        $response->assertStatus(201);
    }

    public function test_cannot_create_event_with_zero_slot()
    {
        $data = array_merge($this->validData, [
            'slot1' => '0',
            'slot2' => '0',
            'slot3' => '0',
            'slot4' => '0'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'slot1' => ['Jumlah slot minimal 1'],
                'slot2' => ['Jumlah slot minimal 1'],
                'slot3' => ['Jumlah slot minimal 1'],
                'slot4' => ['Jumlah slot minimal 1']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_negative_slot()
    {
        $data = array_merge($this->validData, [
            'slot1' => '-1',
            'slot2' => '-1',
            'slot3' => '-1',
            'slot4' => '-1'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'slot1' => ['Jumlah slot minimal 1'],
                'slot2' => ['Jumlah slot minimal 1'],
                'slot3' => ['Jumlah slot minimal 1'],
                'slot4' => ['Jumlah slot minimal 1']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_can_create_event_with_maximum_slot()
    {
        $data = array_merge($this->validData, [
            'slot1' => '999', // Maximum slot
            'slot2' => '999',
            'slot3' => '999',
            'slot4' => '999'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(201);
    }

    public function test_cannot_create_event_with_decimal_slot()
    {
        $data = array_merge($this->validData, [
            'slot1' => '1.5',
            'slot2' => '2.5',
            'slot3' => '3.5',
            'slot4' => '4.5'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);

        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'slot1' => ['Jumlah slot harus berupa angka bulat'],
                'slot2' => ['Jumlah slot harus berupa angka bulat'],
                'slot3' => ['Jumlah slot harus berupa angka bulat'],
                'slot4' => ['Jumlah slot harus berupa angka bulat']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_non_numeric_fund()
    {
        $data = array_merge($this->validData, [
            'fund1' => 'abc',
            'fund2' => 'def',
            'fund3' => 'ghi',
            'fund4' => 'jkl'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);


        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'fund1' => ['Total pendanaan harus berupa angka'],
                'fund2' => ['Total pendanaan harus berupa angka'],
                'fund3' => ['Total pendanaan harus berupa angka'],
                'fund4' => ['Total pendanaan harus berupa angka']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }

    public function test_cannot_create_event_with_non_numeric_slot()
    {
        $data = array_merge($this->validData, [
            'slot1' => 'abc',
            'slot2' => 'def',
            'slot3' => 'ghi',
            'slot4' => 'jkl'
        ]);

        $response = $this->withHeaders($this->headers)
            ->post('/api/event', $data);


        $response->assertStatus(422)->assertJsonFragment([
            'errors' => [
                'slot1' => ['Jumlah slot harus berupa angka bulat'],
                'slot2' => ['Jumlah slot harus berupa angka bulat'],
                'slot3' => ['Jumlah slot harus berupa angka bulat'],
                'slot4' => ['Jumlah slot harus berupa angka bulat']
            ],
            'message' => 'Validation error',
            'status' => 'error'
        ]);
    }
}
