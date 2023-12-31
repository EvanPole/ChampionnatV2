<?php

namespace App\Http\Repositories;

use App\Models\Joueur;
use App\Models\Matche;

class MatchRepository
{
    public function store($request)
    {

        $match = new Matche();
        $match->visiteur = $request->equipe2;
        $match->domicile = $request->equipe1;
        $match->date = $request->date;
        $match->save();

        return redirect()->route('match.index');
    }

    public function update($request, $id)
    {
        $match = Matche::Find($id);
        $match->visiteur = $request->equipe2;
        $match->domicile = $request->equipe1;
        $match->date = $request->date;
        $match->but_domicile = $request->but1;
        $match->but_visiteur = $request->but2;
        $match->save();
        return redirect()->route('match.index');
    }

    public function updatevalidation($request, $id)
    {
        $match = Matche::Find($id);
        $match->but_domicile = $request->but2;
        $match->but_visiteur = $request->but1;
        $match->save();
        return redirect()->route('match.index');
    }
}
