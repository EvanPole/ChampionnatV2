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

        $validatedData = $request->validate([
            'ville' => 'required|string',
            'categorie' => 'required|string',
            'championnat' => 'required|string',
        ]);

        $equipe->ville = $validatedData['ville'];
        $equipe->categorie = $validatedData['categorie'];
        $equipe->championnat = $validatedData['championnat'];
        $equipe->save();
    }

    public function store($request)
    {
        $data = $request->validate([
            'ville' => 'required|string',
            'categorie' => 'required|string',
            'championnat' => 'required|string',
        ]);

        $equipe = new Equipe;
        $equipe->ville = $data['ville'];
        $equipe->categorie = $data['categorie'];
        $equipe->championnat = $data['championnat'];
        $equipe->save();
    }
}
