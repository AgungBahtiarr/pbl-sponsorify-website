<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SponsorSearchTest extends TestCase
{
    protected $token;
    protected $headers;
    protected $role;
    protected $authUser;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');


        // Login untuk mendapatkan token
        $response = $this->post('/api/login', [
            'email' => 'ab@gmail.com',
            'password' => 'adam1234'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');

    }

    public function test_sponsor_search_with_valid_params()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/event/sponsors', [
            'str' => 'JNT Point Poliwangi'

        ]);
        $response->assertStatus(200)
        ->assertSee(["JNT Point Poliwangi"]);


    }

    public function test_sponsor_search_with_no_results()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/event/sponsors', [
            'str' => 'NonExistentSponsor'

        ]);
        $response->assertStatus(200)
        ->assertSee([""]);

    }

    public function test_sponsor_search_without_authentication()
    {
        // Melakukan pencarian sponsor tanpa login
        $response = $this->post('/sponsor/search', [
            'str' => 'JNT Point Poliwangi'
        ]);

        // Memastikan respons redirect ke halaman login
        $response->assertRedirect('/auth/login');
    }

    public function test_sponsor_search_with_categories()
    {
         $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/event/sponsors', [
            'categories' => 'Makanan dan minuman'

        ]);
        $response->assertStatus(200)
        ->assertSee(["categories" => "Makanan dan minuman"]);
    }

    public function test_sponsor_search_with_empty_keyword()
    {

        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/event/sponsors', [
        'str' => ''
        ]);

        $response->assertStatus(200)
    ->assertSee([""]);


    }
}
