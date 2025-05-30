<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Note;
use App\Models\Etudiant;

class DashboardController extends Controller
{
public function index()
{
    // Récupération de tous les étudiants
    $etudiants = Etudiant::all();

    // Calcul des moyennes par étudiant
    $moyennes = Note::select('etudiant_id', DB::raw('AVG(note) as moyenne'))
        ->groupBy('etudiant_id')
        ->pluck('moyenne', 'etudiant_id')
        ->toArray();

    // Récupération des notes avec relations (pour tous les étudiants)
    $notes = Note::with('evaluation', 'etudiant')->get();

    return view('dashboard', compact('notes', 'etudiants', 'moyennes'));
}

}
