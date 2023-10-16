<?php
namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use Illuminate\Http\Request;

class ChampionnatController extends Controller
{
    public function index()
    {
        $currentDate = now();
        $match = Matche::where('date', '>', $currentDate)->get();
        $equipe = Equipe::all();

        return view('championnat', compact('match','equipe'));
    }

}
