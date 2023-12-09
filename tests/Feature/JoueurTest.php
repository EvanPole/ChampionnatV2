<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Bouncer;

class JoueurTest extends TestCase
{

    public function test_joueur_index_page_accces_if_login_admin(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this
        ->actingAs($user)
        ->get('/joueur');
        $response->assertOk();
    }


    public function test_joueur_create_page_accces_if_login_admin(): void
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

    public function test_joueur_store_acces_if_login_admin(): void
    {
        $user = User::factory()->create();
        Bouncer::allow("administrateur")->to('acces');
        Bouncer::assign('administrateur')->to($user);
        Bouncer::refresh();

        $response = $this->actingAs($user)->post(route('joueur.store'), [
            'nom' => 'evan',
            'prenom' => 'evan',
            'email' => 'evan@gmail.com',
            'tel' => '0621345678',
            'equipe_id' => '1',
            'sexe' => '1',
        ]);

        $response->assertRedirect();

    }

}
