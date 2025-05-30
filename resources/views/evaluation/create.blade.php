@extends('layouts.base')
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Ajouter une évaluation</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('evaluation.index') }}">Évaluations</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ajouter</li>
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
                            <div class="card-title">Formulaire d'ajout d'une évaluation</div>
                        </div>

                        @session('success')
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endsession

                        <form action="{{ route('evaluation.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="titre" class="col-sm-3 col-form-label">Titre</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="titre" class="form-control" id="titre" value="{{ old('titre') }}" />
                                        @error('titre')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="date" class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="date" class="form-control" id="date" value="{{ old('date') }}" />
                                        @error('date')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="type" class="col-sm-3 col-form-label">Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" id="type" class="form-control">
                                            <option value="">-- Sélectionnez --</option>
                                            <option value="examen" {{ old('type') == 'examen' ? 'selected' : '' }}>Examen</option>
                                            <option value="devoir" {{ old('type') == 'devoir' ? 'selected' : '' }}>Devoir</option>
                                        </select>
                                        @error('type')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary">Enregistrer</button>
                                <a href="{{ route('evaluation.index') }}" class="btn float-end">Revenir à la liste</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
