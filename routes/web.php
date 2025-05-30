<?php

use App\Http\Controllers\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes Étudiant
Route::get('/etudiant', [EtudiantController::class, 'index'])->name('etudiant.index');
Route::get('/etudiant/create', [EtudiantController::class, 'create'])->name('etudiant.create');
Route::post('/etudiant/store', [EtudiantController::class, 'store'])->name('etudiant.store');
Route::delete('/etudiant/delete/{etudiant}', [EtudiantController::class, 'delete'])->name('etudiant.delete');
Route::get('/etudiant/edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
Route::post('/etudiant/update/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');
// Routes Évaluation
Route::get('/evaluation', [EvaluationController::class, 'index'])->name('evaluation.index');
Route::get('/evaluation/create', [EvaluationController::class, 'create'])->name('evaluation.create');
Route::post('/evaluation/store', [EvaluationController::class, 'store'])->name('evaluation.store');
Route::delete('/evaluation/delete/{evaluation}', [EvaluationController::class, 'delete'])->name('evaluation.delete');
Route::get('/evaluation/edit/{evaluation}', [EvaluationController::class, 'edit'])->name('evaluation.edit');
Route::post('/evaluation/update/{evaluation}', [EvaluationController::class, 'update'])->name('evaluation.update');
// Routes Note
Route::get('/note', [NoteController::class, 'index'])->name('note.index');
Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
Route::post('/note/store', [NoteController::class, 'store'])->name('note.store');
Route::delete('/note/delete/{note}', [NoteController::class, 'delete'])->name('note.delete');
Route::get('/note/edit/{note}', [NoteController::class, 'edit'])->name('note.edit');
Route::put('/note/{note}', [NoteController::class, 'update'])->name('note.update');
