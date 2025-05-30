@extends('layouts.base')
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Modifier une note</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('note.index') }}">Notes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-secondary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Formulaire de modification d'une note</div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('note.update', $note->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="etudiant_id" class="col-sm-3 col-form-label">Étudiant</label>
                                    <div class="col-sm-9">
                                        <select name="etudiant_id" id="etudiant_id" class="form-control">
                                            <option value="">-- Sélectionnez un étudiant --</option>
                                            @foreach($etudiants as $etudiant)
                                                <option value="{{ $etudiant->id }}" {{ ($note->etudiant_id == $etudiant->id) ? 'selected' : '' }}>
                                                    {{ $etudiant->prenom }} {{ $etudiant->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('etudiant_id')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="evaluation_id" class="col-sm-3 col-form-label">Évaluation</label>
                                    <div class="col-sm-9">
                                        <select name="evaluation_id" id="evaluation_id" class="form-control">
                                            <option value="">-- Sélectionnez une évaluation --</option>
                                            @foreach($evaluations as $evaluation)
                                                <option value="{{ $evaluation->id }}" {{ ($note->evaluation_id == $evaluation->id) ? 'selected' : '' }}>
                                                    {{ $evaluation->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('evaluation_id')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="valeur" class="col-sm-3 col-form-label">Note (0-20)</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="valeur" id="valeur" step="0.1" min="0" max="20" class="form-control" value="{{ old('valeur', $note->valeur) }}" required>
                                        @error('valeur')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <a href="{{ route('note.index') }}" class="btn btn-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
