<!-- resources/views/fournisseurs/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Détails du fournisseur {{ $fournisseur->nom }}</h1>

    <a href="{{ route('fournisseurs.index') }}"><button class="btn btn-secondary">Retourner</button></a>

    <p>ID du fournisseur: {{ $fournisseur->id }}</p>
    <p>Nom : {{ $fournisseur->nom }}</p>
    <p>Référence IRIS : {{ $fournisseur->reference_iris }}</p>

    <a href="{{ route('fournisseurs.edit', $fournisseur->id) }}"><button class="btn btn-primary">Modifier</button></a>
    <br>

    <form method="post" action="{{ route('fournisseurs.destroy', $fournisseur->id) }}">
        @csrf
        @method('DELETE')
        <br>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
@endsection
