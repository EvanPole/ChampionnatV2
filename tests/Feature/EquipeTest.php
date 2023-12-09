<?php

namespace Tests\Feature;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
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
    public function test_index_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("acces")->to('acces');
        Bouncer::assign('acces')->to($user);
        Bouncer::refresh();

        $equipe1 = Equipe::factory()->create();
        $equipe2 = Equipe::factory()->create();

        $match1 = Matche::factory()->create([
            'domicile' => $equipe1->id,
            'visiteur' => $equipe2->id,
            'but_domicile' => 2,
            'but_visiteur' => 1,
        ]);

        $match2 = Matche::factory()->create([
            'domicile' => $equipe2->id,
            'visiteur' => $equipe1->id,
            'but_domicile' => 1,
            'but_visiteur' => 1,
        ]);

        Joueur::factory()->count(3)->create(['equipe_id' => $equipe1->id]);
        Joueur::factory()->count(2)->create(['equipe_id' => $equipe2->id]);


        $response = $this->actingAs($user)->get('/equipe');

        $response->assertStatus(200);
        $response->assertViewIs('equipe.equipeliste');
        $response->assertViewHas(['equipe', 'matche', 'playerCounts', 'victoires', 'defaites', 'nul']);



        $this->assertDatabaseHas('equipes', ['id' => $equipe1->id]);
        $this->assertDatabaseHas('equipes', ['id' => $equipe2->id]);
        $this->assertDatabaseHas('matches', ['id' => $match1->id]);
        $this->assertDatabaseHas('matches', ['id' => $match2->id]);
        $this->assertDatabaseHas('joueurs', ['equipe_id' => $equipe1->id]);
        $this->assertDatabaseHas('joueurs', ['equipe_id' => $equipe2->id]);

        $response->assertViewHas('victoires', [$equipe1->id => 1, $equipe2->id => 0]);
        $response->assertViewHas('defaites', [$equipe1->id => 0, $equipe2->id => 1]);
        $response->assertViewHas('nul', [$equipe1->id => 1, $equipe2->id => 1]);
        $response->assertViewHas('playerCounts', [$equipe1->id => 3, $equipe2->id => 2]);
    }

    public function test_equipe_show_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();
        $equipe = Equipe::factory()->create();


        $response = $this->actingAs($user)->get("/equipe/".$equipe->id);

        $response->assertOk();
    }

    public function test_edit_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $equipe = Equipe::factory()->create();
        $joueur = Joueur::factory()->create(['equipe_id' => $equipe->id]);

        $response = $this->actingAs($user)->get("/equipe/{$equipe->id}/edit");

        $response->assertOk();
    }

    public function test_update_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $equipe = Equipe::factory()->create();

        $response = $this->actingAs($user)->patch("/equipe/{$equipe->id}", [
            'ville' => 'saint brevin',
            'categorie' => 'league 2',
            'championnat' => 'france'
        ]);
        $response->assertStatus(302);
    }

    public function test_destroy_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $equipe = Equipe::factory()->create();

        $this->assertDatabaseHas('equipes', ['id' => $equipe->id]);

        $response = $this
            ->actingAs($user)
            ->delete("/equipe/{$equipe->id}");
    }



    public function test_equipe_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this->actingAs($user)->get('/equipe');

        $response->assertStatus(200);
    }





    public function test_equipe_page_accces_if_login_admin(): void
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


    public function test_equipe_create_page_accces_if_login_admin(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this
        ->actingAs($user)
        ->get('/equipe/create');
        $response->assertOk();
    }

    public function test_equipe_store_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this->actingAs($user)->post(route('equipe.store'), [
            'ville' => 'Pornic',
            'categorie' => 'Pro',
            'championnat' => 'L1 ubereat',
        ]);

        $response->assertRedirect();

    }




}
