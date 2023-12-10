<?php

namespace Tests\Feature;

use App\Models\Equipe;
use App\Models\Matche;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Bouncer;

class ChampionnatTest extends TestCase
{
    use DatabaseTransactions;

    public function test_index(): void
    {

        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this->actingAs($user)->get('/championnat');
        $response->assertStatus(200);
    }
}
