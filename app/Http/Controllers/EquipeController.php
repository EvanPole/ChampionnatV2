<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EquipeRepository;
use App\Http\Requests\EquipeRequest;
use App\Mail\EditEmail;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Matche;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;

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

        if (Auth::user()->can('acces')) {
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->can('acces')) {

            return view('equipe.equipecreate');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipeRequest $request)
    {
        if (Auth::user()->can('acces')) {
            $this->repository->store($request);

            // Mail::to(Auth::user()->email)->send(new EditEmail($request));
            return redirect()->route('equipe.index');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Equipe $equipe)
    {
        if (Auth::user()->can('acces')) {
            return view('equipe.equipeshow', compact('equipe'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->can('acces')) {
            $equipe = Equipe::Find($id);
            $player = Joueur::where('equipe_id', $equipe->id)->get();

            return view('equipe.equipemodification', compact('player', 'equipe'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipeRequest $request, string $id)
    {
        if (Auth::user()->can('acces')) {
            $this->repository->update($request, $id);
            return redirect()->route('equipe.index');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        if (Auth::user()->can('acces')) {
            $equipe->delete();

            return redirect()->route('equipe.index');
        }
    }
}
