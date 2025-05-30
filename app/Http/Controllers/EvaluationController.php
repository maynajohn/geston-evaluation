<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    // Afficher la liste des évaluations
    public function index()
    {
        $evaluations = Evaluation::orderBy('date', 'desc')->paginate(5);

        return view('evaluation.index', [
            'evaluations' => $evaluations,
        ]);
    }

    // Affiche le formulaire pour ajouter une évaluation
    public function create()
    {
        return view('evaluation.create');
    }

    // Ajouter une évaluation
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:examen,devoir'
        ]);

        Evaluation::create($request->all());

        return redirect()->route('evaluation.create')->with('success', 'Évaluation ajoutée avec succès');
    }

    // Suppression d'une évaluation
    public function delete(Evaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('evaluation.index')->with('success', 'Évaluation supprimée avec succès');
    }

    // Affiche les données à modifier
    public function edit(Evaluation $evaluation)
    {
        return view('evaluation.edit', compact('evaluation'));
    }

    // Modifier les données et enregistrer
    public function update(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'date' => 'required|date',
            'type' => 'required|in:examen,devoir'
        ]);

        $evaluation->update($request->all());

        return redirect()->route('evaluation.index')->with('success', 'Évaluation modifiée avec succès');
    }
}
