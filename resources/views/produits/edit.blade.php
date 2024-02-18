<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Modifier le produit {{ $produit->nom }}</h1>

    <a href="{{ route('produits.show', $produit->id) }}"><button class="btn btn-secondary">Retourner</button></a>

    @if (session('error_fournisseur'))
        <div class="alert alert-danger">
            {{ session('error_fournisseur') }}
        </div>
    @endif

    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="fournisseur_nom" class="form-label">Nom du fournisseur :</label>
            <input type="text" name="fournisseur_nom" class="form-control @error('fournisseur_nom') is-invalid @enderror" value="{{ $produit->fournisseur->nom }}">
            @error('fournisseur_nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="designation" class="form-label">Désignation :</label>
            <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ $produit->designation }}">
            @error('designation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>       
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    
@endsection
