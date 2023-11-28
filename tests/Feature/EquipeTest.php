<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Bouncer;
use Tests\TestCase;

class EquipeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_equipe_page_acces(): void
    {
        $response = $this->get('/equipe');

        $response->assertStatus(302);
    }

    public function test_equipe_page_accces_if_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this
        ->actingAs($user)
        ->get('/equipe');
        $response->assertOk();
    }

}
