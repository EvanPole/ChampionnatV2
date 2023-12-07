<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatchTest extends TestCase
{
    public function test_match_page_acces_no_login(): void
    {
        $response = $this->get('/match');

        $response->assertStatus(302);
    }

    public function test_match_create_page_acces_no_login(): void
    {
        $response = $this->get('/match/store');

        $response->assertStatus(302);
    }
    public function test_match_store_page_acces_no_login(): void
    {
        $response = $this->get('/match/create');

        $response->assertStatus(302);
    }

    public function test_match_show_page_acces_no_login(): void
    {
        $response = $this->get('/match/show');

        $response->assertStatus(302);
    }
    public function test_match_edit_page_acces_no_login(): void
    {
        $response = $this->get('/match/edit');

        $response->assertStatus(302);
    }

    public function test_match_destroy_page_acces_no_login(): void
    {
        $response = $this->get('/joueur/destroy');

        $response->assertStatus(302);
    }

}
