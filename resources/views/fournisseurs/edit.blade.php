<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Modifier le fournisseur {{ $fournisseur->nom }}</h1>

    <a href="{{ route('fournisseurs.show', $fournisseur->id) }}"><button class="btn btn-secondary">Retourner</button></a>

    <form method="post" action="{{ route('fournisseurs.update', $fournisseur->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ $fournisseur->nom }}">
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="reference_iris" class="form-label">Référence IRIS :</label>
            <input type="texte" name="reference_iris" class="form-control @error('reference_iris') is-invalid @enderror" value="{{ $fournisseur->reference_iris }}">
            @error('fournisseur')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
