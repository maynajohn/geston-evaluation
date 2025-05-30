<?php

use App\Http\Controllers\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Routes Étudiant
Route::get('/etudiant', [EtudiantController::class, 'index'])->name('etudiant.index');
Route::get('/etudiant/create', [EtudiantController::class, 'create'])->name('etudiant.create');
Route::post('/etudiant/store', [EtudiantController::class, 'store'])->name('etudiant.store');
Route::delete('/etudiant/delete/{etudiant}', [EtudiantController::class, 'delete'])->name('etudiant.delete');
Route::get('/etudiant/edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
Route::post('/etudiant/update/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');