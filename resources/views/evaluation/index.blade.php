@extends('layouts.base')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3>Évaluations</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Évaluations</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card mb-4">
        <div class="card-header">
                            <a href="{{ route('evaluation.create') }}" class="btn btn-primary">Ajouter une évaluation</a>
                        </div>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Titre</th>
                    <th>Type</th>
                    <th style="width: 130px;">Date</th>
                    <th style="width: 130px;" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->titre }}</td>
                    <td>{{ ucfirst($evaluation->type) }}</td>
                    <td>{{ \Carbon\Carbon::parse($evaluation->date)->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <a href="{{ route('note.create', ['evaluation_id' => $evaluation->id]) }}" 
                           class="btn btn-sm btn-primary px-3">
                            Saisir
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
