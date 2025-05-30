@extends('layouts.base')
@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="mb-0">Saisie des notes</h3>
                    @if ($evaluation)
                        <p class="text-muted mb-0">
                            <strong>Évaluation :</strong> {{ $evaluation->titre }} <br>
                            <strong>Type :</strong> {{ ucfirst($evaluation->type) }}
                        </p>
                    @endif
                </div>
                <div class="col-sm-4 text-end">
                    <a href="{{ route('evaluation.index') }}" class="btn btn-secondary">← Retour</a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content mt-3">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Nom de l'étudiant</th>
                                <th style="width: 400px">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($etudiants as $index => $etudiant)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                                    <td>
                                        @if($notes->has($etudiant->id))
                                            <span class="text-success">
                                                ({{ $notes[$etudiant->id]->note }}/20)
                                            </span>
                                        @else
                                            <form action="{{ route('note.store') }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                <input type="hidden" name="etudiant_id" value="{{ $etudiant->id }}">
                                                <input type="hidden" name="evaluation_id" value="{{ $evaluationId }}">
                                                <input type="number" name="valeur" class="form-control form-control-sm me-2" placeholder="Note /20" step="0.1" min="0" max="20" required>
                                                <button type="submit" class="btn btn-primary btn-sm">Saisir</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Aucun étudiant trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection