<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Sponsor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SponsorSearchUnitTest extends TestCase
{
    use RefreshDatabase;
    protected $token;
    protected $headers;
    protected $role;
    protected $authUser;

    protected function setUp(): void
    {
        parent::setUp();
    

        $response = $this->post('/api/login', [
            'email' => 'ab@gmail.com',
            'password' => 'adam1234'
        ]);

        $this->token = $response->json('token');
        $this->role = $response->json('user.id_role');
        $this->authUser = $response->json('user.id');
    }
    /** @test */
    public function search_returns_correct_results_for_valid_keyword()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/event/sponsors', [
            'str' => 'JNT Point Poliwangi'

        ]);

        $response->assertStatus(200);
        $response->assertSee('JNT Point Poliwangi');
        $response->assertDontSee('Other Sponsor');
    }

    /** @test */
    public function search_returns_no_results_for_nonexistent_keyword()
    {
        $response = $this->withCookies(['token' => $this->token, 'roleUser' => $this->role, 'authUser' => $this->authUser])->get('/event/sponsors', [
            'str' => 'NonExistentSponsor'

        ]);

        $response->assertStatus(200);
        $response->assertSee('');
    }

    /** @test */
    public function search_requires_authentication()
    {
        $response = $this->post('/sponsor/search', ['str' => 'JNT Point Poliwangi']);

        $response->assertRedirect('/auth/login');
    }
}
