<?php

namespace App\Http\Controllers;

use App\Http\Repositories\JoueurRepository;
use App\Http\Requests\JoueurRequest;
use App\Models\Equipe;
use App\Models\Joueur;
use Illuminate\Http\Request;
use Auth;

class JoueurController extends Controller
{
    private $repository;

    public function __construct(JoueurRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipes = Equipe::all();
        $eqjoueurs = [];

        foreach ($equipes as $equipe) {
            $joueursEquipe = Joueur::where('equipe_id', $equipe->id)->get();

            $eqjoueurs[] = [
                'equipe' => $equipe,
                'joueurs' => $joueursEquipe,
            ];
        }
        if (Auth::user()->can('acces')) {

            return view('joueur.joueurliste', compact('eqjoueurs'));
        }
        abort(401);
    }



    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $equipes = Equipe::all();
        if (Auth::user()->can('acces')) {

            return view('joueur.joueurcreate', compact('equipes'));
        }
        abort(401);
    }


    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(JoueurRequest $request)
    {

        if (Auth::user()->can('acces')) {
            $this->repository->store($request);

            return redirect()->route('joueur.index')->with('success', 'Le joueur a été créé avec succès.');
        }
        abort(401);
    }


    /**
     * Display the specified resource.
     */
    public function show(Joueur $joueur)
    {
        if (Auth::user()->can('acces')) {

            return view('joueur.joueurshow', compact('joueur'));
        }
        abort(401);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $joueur = Joueur::Find($id);
        $equipes = Equipe::all();
        if (Auth::user()->can('acces')) {

            return view('joueur.joueurmodification', compact('joueur', 'equipes'));
        }
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JoueurRequest $request, string $id)
    {
        if (Auth::user()->can('acces')) {

            $this->repository->update($request, $id);

            return redirect()->route('joueur.index');
        }
        abort(401);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Joueur $joueur)
    {
        if (Auth::user()->can('acces')) {

            $joueur->delete();
            return redirect()->route('joueur.index');
        }
        abort(401);
    }
}
