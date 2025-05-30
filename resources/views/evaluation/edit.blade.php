@extends('layouts.base')
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Modifier une évaluation</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('evaluation.index') }}">Évaluations</a></li>
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
                            <div class="card-title">Formulaire de modification d'une évaluation</div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('evaluation.update', $evaluation->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="titre" class="col-sm-3 col-form-label">Titre</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="titre" id="titre" value="{{ old('titre', $evaluation->titre) }}" class="form-control" />
                                        @error('titre')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="date" class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="date" id="date" value="{{ old('date', $evaluation->date->format('Y-m-d')) }}" class="form-control" />
                                        @error('date')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="type" class="col-sm-3 col-form-label">Type</label>
                                    <div class="col-sm-9">
                                        <select name="type" id="type" class="form-control">
                                            <option value="" {{ $evaluation->type == '' ? 'selected' : '' }}>-- Sélectionnez --</option>
                                            <option value="controle" {{ $evaluation->type == 'controle' ? 'selected' : '' }}>Contrôle</option>
                                            <option value="examen" {{ $evaluation->type == 'examen' ? 'selected' : '' }}>Examen</option>
                                            <option value="tp" {{ $evaluation->type == 'tp' ? 'selected' : '' }}>TP</option>
                                        </select>
                                        @error('type')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary">Mettre à jour</button>
                                <a href="{{ route('evaluation.index') }}" class="btn float-end">Revenir sur la liste</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
