<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    // Afficher la liste des notes
    public function index()
    {
        $notesParEvaluation = Note::with('etudiant', 'evaluation')
            ->get()
            ->groupBy('evaluation_id');

        return view('note.index', compact('notesParEvaluation'));
    }

    // Affiche le formulaire pour ajouter une note
    public function create(Request $request)
    {
        $evaluationId = $request->query('evaluation_id');
        $etudiants = Etudiant::all();
        $evaluations = Evaluation::all();

        $notes = collect();
        $evaluation = null;

        if ($evaluationId) {
            $notes = Note::where('evaluation_id', $evaluationId)->get()->keyBy('etudiant_id');
            $evaluation = Evaluation::find($evaluationId);
        }

        return view('note.create', compact('etudiants', 'evaluations', 'notes', 'evaluationId', 'evaluation'));
    }

    // Ajouter une note
    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'evaluation_id' => 'required|exists:evaluations,id',
            'valeur' => 'required|numeric|min:0|max:20'
        ]);

        Note::create([
            'etudiant_id' => $request->etudiant_id,
            'evaluation_id' => $request->evaluation_id,
            'note' => $request->valeur,
        ]);

        return redirect()->route('note.create', ['evaluation_id' => $request->evaluation_id])
                         ->with('success', 'Note enregistrée avec succès');
    }

    // Suppression d'une note
    public function delete(Note $note)
    {
        $note->delete();
        return redirect()->route('note.index')->with('success', 'Note supprimée avec succès');
    }

    public function edit(Note $note)
    {
        $etudiants = Etudiant::all();
        $evaluations = Evaluation::all();
        return view('note.edit', compact('note', 'etudiants', 'evaluations'));
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'evaluation_id' => 'required|exists:evaluations,id',
            'note' => 'required|numeric|min:0|max:20'
        ]);

        $note->update($request->all());

        return redirect()->route('note.index')->with('success', 'Note modifiée avec succès');
    }
}