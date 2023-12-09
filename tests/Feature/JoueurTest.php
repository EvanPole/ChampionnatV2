<?php

namespace Tests\Feature;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Bouncer;

class JoueurTest extends TestCase
{
    use RefreshDatabase;
     //index
     public function test_joueur_index_page_acces_if_login_admin()
     {
         $user = User::factory()->create();
         Bouncer::allow("administrateur")->to('acces');
         Bouncer::assign('administrateur')->to($user);
         Bouncer::refresh();

         $equipe1 = Equipe::factory()->create(['ville' => 'Dumas']);
         $equipe2 = Equipe::factory()->create(['ville' => 'Aubryboeuf']);
         $joueur1 = Joueur::factory()->create(['equipe_id' => $equipe1->id]);
         $joueur2 = Joueur::factory()->create(['equipe_id' => $equipe2->id]);

         $response = $this->actingAs($user)->get(route('joueur.index'));

         $response->assertStatus(200);

         $response->assertViewIs('joueur.joueurliste');
     }

    // create
    public function test_joueur_create_page_acces_if_login_admin(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this
        ->actingAs($user)
        ->get('/joueur/create');
        $response->assertOk();
    }
    // store
    public function test_joueur_store_acces_if_login_admin(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();
        $Equipe = Equipe::factory()->create();

        $response = $this->actingAs($user)->post('/joueur', [
            'nom' => 'evan',
            'prenom' => 'evan',
            'email' => 'evan@gmail.com',
            'tel' => '0621345678',
            'joueur_id' => '1',
            'sexe' => '1',
            'equipe_id' => $Equipe->id,
        ]);

        $response->assertRedirect();

    }
    // show
    public function test_joueur_show_page_acces_login(): void
    {

        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        Equipe::factory()->create();
        $joueur = Joueur::factory()->create();

        $response = $this->actingAs($user)->get("/joueur/".$joueur->id);

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
        $joueur = Joueur::factory()->create();

        $response = $this->actingAs($user)->get("/joueur/{$joueur->id}/edit");

        $response->assertOk();
    }
    // update
    public function test_joueur_update_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        Equipe::factory()->create();
        $eq2 = Equipe::factory()->create();
        $Joueur = Joueur::factory()->create();


        $response = $this->actingAs($user)->patch("/joueur/{$Joueur->id}", [
            'nom' => 'Evan',
            'prenom' => 'Lol',
            'email' => 'fkeunfiu@feukn.fr',
            'tel' => '0621059254',
            'sexe' => 0,
            'equipe_id' => $eq2->id,
        ]);

        $updatedJoueur = Joueur::find($Joueur->id);
        $this->assertEquals('Evan', $updatedJoueur->nom);

        $response->assertStatus(302);
    }

    // destroy
    public function test_joueur_destroy_page_acces_login(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        Equipe::factory()->create();
        $joueur = Joueur::factory()->create();

        $this->assertDatabaseHas('joueurs', ['id' => $joueur->id]);

        $response = $this
            ->actingAs($user)
            ->delete("/joueur/{$joueur->id}");
        $response->assertStatus(302);

    }

}
