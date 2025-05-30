<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EtudiantController extends Controller
{
    // Afficher la liste des étudiants
    public function index()
    {
        $etudiants = Etudiant::orderBy('nom', 'asc')->paginate(2);

        return view('etudiant.index', [
            'etudiants' => $etudiants,
        ]);
    }

    // Affiche le formulaire pour ajouter un étudiant
    public function create()
    {
        return view('etudiant.create');
    }

    // Ajouter un étudiant
    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required|min:2|max:255',
            'nom' => 'required|min:2|max:255',
            'date_naissance' => 'required|date'
        ]);

        try {
            Etudiant::create([
                'prenom' => $request->input('prenom'),
                'nom' => $request->input('nom'),
                'date_naissance' => $request->input('date_naissance')
            ]);
            return redirect()->route('etudiant.create')
                ->with('success', 'Étudiant enregistré avec succès');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    // Suppression d'un étudiant
    public function delete(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiant.index')->with('success', 'Étudiant supprimé avec succès');
    }

    // Afficher les données à modifier
    public function edit(Etudiant $etudiant)
    {
        return view('etudiant.edit', compact('etudiant'));
    }

    // Modifier les données et enregistrer en base de données
    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'prenom' => 'required|min:2|max:255',
            'nom' => 'required|min:2|max:255',
            'date_naissance' => 'required|date'
        ]);

        $etudiant->update([
            'prenom' => $request->input('prenom'),
            'nom' => $request->input('nom'),
            'date_naissance' => $request->input('date_naissance')
        ]);

        return redirect()->route('etudiant.index')->with('success', 'Étudiant modifié avec succès');
    }
}
