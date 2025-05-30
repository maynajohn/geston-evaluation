@extends('layouts.base')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Modifier un professeur</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('professeur.index') }}">Professeur</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!--begin::Horizontal Form-->
                    <div class="card card-secondary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Formulaire de modification d'un professeur</div>
                        </div>

                        @session('success')
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endsession
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('professeur.update', $professeur->id) }}" method="POST">
                            @csrf
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label">Prénom & Nom</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $professeur->nomComplet }}" name="nom_complet"
                                            class="form-control" id="name" />
                                        @error('nom_complet')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <label for="phone" class="col-sm-3 col-form-label">Téléphone</label>
                                    <div class="col-sm-9">
                                        <input type="number" value="{{ $professeur->telephone }}" name="telephone"
                                            class="form-control" id="phone" />
                                        @error('telephone')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label for="matiere" class="col-sm-3 col-form-label">Matière</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="matiere" id="matiere">
                                            <option {{ $professeur->matiere == '' ? 'selected' : '' }} value="">
                                                --Selectionnez--</option>
                                            <option {{ $professeur->matiere == 'PHP' ? 'selected' : '' }} value="PHP">PHP
                                            </option>
                                            <option {{ $professeur->matiere == 'UML' ? 'selected' : '' }} value="UML">
                                                UML</option>
                                            <option {{ $professeur->matiere == 'LANGUAGE C' ? 'selected' : '' }}
                                                value="LANGUAGE C">LANGUAGE C</option>
                                            <option {{ $professeur->matiere == 'PROTECTION SI' ? 'selected' : '' }}
                                                value="PROTECTION SI">PROTECTION SI</option>
                                        </select>
                                        @error('matiere')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary">Mettre à jour</button>
                                <a href="{{ route('professeur.index') }}" class="btn float-end">Revenir sur la liste</a>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Horizontal Form-->
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!--end::Row-->
        </div>
    </div>
    <!--end::App Content-->
@endsection
