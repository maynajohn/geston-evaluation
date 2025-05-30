@extends('layouts.base')
@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-3">Tableau de bord</h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if($etudiants->isEmpty())
                    <div class="alert alert-info text-center">Aucun étudiant trouvé.</div>
                @else
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Étudiant</th>
                                <th>Moyenne générale</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                                    <td>
                                        {{ number_format($moyennes[$etudiant->id] ?? 0, 2, ',', ' ') }}
                                    </td>
                                    <td>
                                        <!-- Bouton pour ouvrir le modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEtudiant{{ $etudiant->id }}">
                                            Voir moyenne
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modals -->
                    @foreach($etudiants as $etudiant)
                        <div class="modal fade" id="modalEtudiant{{ $etudiant->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $etudiant->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $etudiant->id }}">Notes de {{ $etudiant->prenom }} {{ $etudiant->nom }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            // Filtrer les notes de cet étudiant
                                            $notesEtudiant = $notes->where('etudiant_id', $etudiant->id);
                                        @endphp

                                        @if($notesEtudiant->isEmpty())
                                            <p>Aucune note enregistrée pour cet étudiant.</p>
                                        @else
                                            <table class="table table-sm table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Évaluation</th>
                                                        <th>Type</th>
                                                        <th>Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($notesEtudiant as $note)
                                                        <tr>
                                                            <td>{{ $note->evaluation->titre }}</td>
                                                            <td>{{ ucfirst($note->evaluation->type) }}</td>
                                                            <td>{{ number_format($note->note, 1, ',', ' ') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <p class="text-end fw-bold">
                                                Moyenne générale : {{ number_format($moyennes[$etudiant->id] ?? 0, 2, ',', ' ') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
        </div>
    </div>
</div>
@endsection
