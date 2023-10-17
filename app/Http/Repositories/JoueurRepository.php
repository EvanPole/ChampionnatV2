<?php

namespace App\Http\Repositories;

use App\Models\Joueur;

class JoueurRepository
{
    public function store($request)
    {

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
