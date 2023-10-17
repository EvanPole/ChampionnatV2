<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MatchRepository;
use App\Http\Requests\MatcheRequest;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    private $repository;

    public function __construct(MatchRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Equipe $equipe, Matche $matche)
    {
        $match = Matche::all();
        $equipe = Equipe::all();

        $playerCounts = [];

        foreach ($equipe as $equipes) {
            $playerCount = Joueur::where('equipe_id', $equipes->id)->count();
            $playerCounts[$equipes->id] = $playerCount;
        }

        return view('match.matchliste', compact('equipe', 'match', 'playerCounts'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipes = Equipe::all();
        return view('match.matchcreate', compact('equipes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->repository->store($request);
        return redirect()->route('match.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Matche $match)
    {
        $equipe = Equipe::all();

        return view('match.matchshow', compact('equipe', 'match'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matche $match)
    {
        $equipes = Equipe::all();

        return view('match.matchmodification', compact('equipes', 'match'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatcheRequest $request, string $id)
    {
        $this->repository->update($request,$id);
        return redirect()->route('match.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matche $match)
    {
        $match->delete();
        return redirect()->route('match.index');
    }
}
