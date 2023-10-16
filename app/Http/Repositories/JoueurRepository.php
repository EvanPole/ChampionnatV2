<?php

namespace App\Http\Repositories;

use App\Models\Joueur;

class JoueurRepository
{
    public function store($request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'equipe_id' => 'required',
            'sexe' => 'required|in:0,1',
        ]);

        $joueur = new Joueur();
        $joueur->nom = $request->nom;
        $joueur->prenom = $request->prenom;
        $joueur->email = $request->email;
        $joueur->tel = $request->tel;
        $joueur->equipe_id = $request->equipe_id;
        $joueur->sexe = $request->sexe;

        $joueur->save();

    }

    public function update($request, $id)
    {
        $joueur = Joueur::find($id);

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'equipe_id' => 'required',
            'sexe' => 'required|in:0,1',
        ]);

        $joueur->nom = $request->nom;
        $joueur->prenom = $request->prenom;
        $joueur->email = $request->email;
        $joueur->tel = $request->tel;
        $joueur->equipe_id = $request->equipe_id;
        $joueur->sexe = $request->sexe;

        $joueur->save();

        return redirect()->route('joueur.index');
    }

}
