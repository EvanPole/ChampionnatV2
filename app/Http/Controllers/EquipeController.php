<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EquipeRepository;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use Illuminate\Http\Request;

class EquipeController extends Controller
{

    private $repository;

    public function __construct(EquipeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matche = Matche::all();
        $equipe = Equipe::all();

        $playerCounts = [];
        $victoires = [];
        $defaites = [];
        $nul = [];

        foreach ($equipe as $equipes) {
            $victoires[$equipes->id] = 0;
            $defaites[$equipes->id] = 0;
            $nul[$equipes->id] = 0;

            foreach ($matche as $matches) {
                if ($matches->domicile == $equipes->id) {
                    if ($matches->but_domicile > $matches->but_visiteur) {
                        $victoires[$equipes->id] += 1;
                    } elseif ($matches->but_domicile < $matches->but_visiteur) {
                        $defaites[$equipes->id] += 1;
                    } else {
                        $nul[$equipes->id] += 1;
                    }
                } elseif ($matches->visiteur == $equipes->id) {
                    if ($matches->but_visiteur > $matches->but_domicile) {
                        $victoires[$equipes->id] += 1;
                    } elseif ($matches->but_visiteur < $matches->but_domicile) {
                        $defaites[$equipes->id] += 1;
                    } else {
                        $nul[$equipes->id] += 1;
                    }
                }
            }

            $playerCount = Joueur::where('equipe_id', $equipes->id)->count();
            $playerCounts[$equipes->id] = $playerCount;
        }

        return view('equipe.equipeliste', compact('equipe', 'matche', 'playerCounts', 'victoires', 'defaites', 'nul'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipe.equipecreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->repository->store($request);

        return redirect()->route('equipe.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Equipe $equipe)
    {
        return view('equipe.equipeshow', compact('equipe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipe = Equipe::Find($id);
        $player = Joueur::where('equipe_id', $equipe->id)->get();

        return view('equipe.equipemodification', compact('player', 'equipe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->repository->update($request, $id);
        return redirect()->route('equipe.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        $equipe->delete();

        return redirect()->route('equipe.index');
    }
}