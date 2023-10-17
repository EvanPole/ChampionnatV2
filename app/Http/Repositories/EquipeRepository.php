<?php

namespace App\Http\Repositories;

use App\Models\Equipe;

class EquipeRepository
{
    public function update($request, $id)
    {
        $equipe = Equipe::find($id);

        if (!$equipe) {
            return redirect()->route('equipe.index')->with('error', 'Équipe introuvable.');
        }


        $equipe->ville = $request['ville'];
        $equipe->categorie = $request['categorie'];
        $equipe->championnat = $request['championnat'];
        $equipe->save();
    }

    public function store($request)
    {


        $equipe = new Equipe;
        $equipe->ville = $request['ville'];
        $equipe->categorie = $request['categorie'];
        $equipe->championnat = $request['championnat'];
        $equipe->save();

    }
}
