@extends('layouts.base')
@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-0">Liste des notes</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('evaluation.index') }}" class="btn btn-primary">Ajouter une note</a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <!-- Barre de recherche -->
        <form method="GET" action="{{ route('note.index') }}" class="mb-4">
            <div class="input-group w-50 mx-auto">
                <input type="text" name="search" class="form-control" placeholder="Rechercher une évaluation..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
            </div>
        </form>

        @forelse($notesParEvaluation as $evaluationId => $notes)
            <div class="card mb-4" style="max-width: 100%; overflow-x: auto;">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Évaluation : {{ $notes->first()->evaluation->titre }}</h5>
                    <small>Type : {{ ucfirst($notes->first()->evaluation->type) }}</small>
                </div>

                <div class="card-body p-0">
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Étudiant</th>
                                <th>Note</th>
                                <th style="width: 200px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $index => $note)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}</td>
                                    <td>{{ $note->note }}/20</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('note.edit', $note->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $note->id }}">
                                                Supprimer
                                            </button>
                                        </div>

                                        <!-- Modal suppression -->
                                        <div class="modal fade" id="deleteModal{{ $note->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $note->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel{{ $note->id }}">Confirmation suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Voulez-vous vraiment supprimer cette note ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <form action="{{ route('note.delete', $note->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Confirmer</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Aucune note disponible.</div>
        @endforelse
    </div>
</div>
@endsection