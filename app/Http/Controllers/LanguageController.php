<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    use RefreshDatabase;

    public function test_changeLanguage_redirects_back_with_valid_language()
    {
        // Crée une requête avec un langage valide (par exemple, 'fr')
        $response = $this->post(route('change.language'), ['language' => 'fr']);

        // Vérifie que la redirection est effectuée
        $response->assertStatus(302);

        // Vérifie que la session et la locale ont été mises à jour correctement
        $this->assertEquals('fr', Session::get('locale'));
        $this->assertEquals('fr', App::getLocale());

        // Vérifie que la redirection s'est faite vers la page précédente
        $response->assertRedirect()->assertSessionHasNoErrors();
    }
}
