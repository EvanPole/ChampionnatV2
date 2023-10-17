<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MatchRepository;
use App\Http\Requests\MatcheRequest;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use Illuminate\Http\Request;
use Auth;

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
        if (Auth::user()->can('acces') or Auth::user()->can('match-edit')) {
            return view('match.matchliste', compact('equipe', 'match', 'playerCounts'));
        }
        abort(401);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (Auth::user()->can('acces')) {
            $equipes = Equipe::all();
            return view('match.matchcreate', compact('equipes'));
        }
        abort(401);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatcheRequest $request)
    {
        if (Auth::user()->can('acces')) {
            $this->repository->store($request);
            return redirect()->route('match.index');
        }
        abort(401);
    }


    /**
     * Display the specified resource.
     */
    public function show(Matche $match)
    {
        if (Auth::user()->can('acces')) {
            $equipe = Equipe::all();

            return view('match.matchshow', compact('equipe', 'match'));
        }
        abort(401);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matche $match)
    {
        if (Auth::user()->can('match-edit')) {
            $equipes = Equipe::all();
            return view('match.matchmodification', compact('equipes', 'match'));
        }
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatcheRequest $request, string $id)
    {
        if (Auth::user()->can('acces')) {
            $this->repository->update($request, $id);
            return redirect()->route('match.index');
        }
        abort(401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matche $match)
    {
        if (Auth::user()->can('acces')) {
            $match->delete();
            return redirect()->route('match.index');
        }
        abort(401);
    }
}
