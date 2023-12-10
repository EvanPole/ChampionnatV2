<?php

namespace Tests\Feature;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Bouncer;

class MatchTest extends TestCase
{

    public function test_match_index_page_acces_if_login()
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this->actingAs($user)->get(route('match.index'));

        $response->assertStatus(200);

        $user2 = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user2);
        Bouncer::refresh();

        $response = $this->actingAs($user2)->get(route('match.index'));

        $response->assertStatus(200);
    }

    //create
    public function test_match_create_page_acces_if_login_admin(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/match/create');
        $response->assertOk();
    }



    // show
    public function test_match_show_page_acces_login(): void
    {

        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        Equipe::factory()->create();
        Equipe::factory()->create();
        $match = Matche::factory()->create();

        $response = $this->actingAs($user)->get("/match/" . $match->id);

        $response->assertOk();
    }

    // edit
    public function test_joueur_edit_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        Equipe::factory()->create();
        $Match = Matche::factory()->create();

        $response = $this->actingAs($user)->get("/match/{$Match->id}/edit");

        $response->assertOk();

        $user2 = User::factory()->create();
        Bouncer::allow("arbitre")->to('match-edit');
        Bouncer::assign('arbitre')->to($user2);
        Bouncer::refresh();

        $response = $this->actingAs($user2)->get("/match/{$Match->id}/edit");

        $response->assertOk();
    }

    // destroy

    public function test_destroy_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $match = Matche::factory()->create();

        $this->assertDatabaseHas('matches', ['id' => $match->id]);

        $response = $this
            ->actingAs($user)
            ->delete("/match/{$match->id}");
        $response->assertStatus(302);
    }
}
