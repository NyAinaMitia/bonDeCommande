<!-- resources/views/produits/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Détails du produit {{ $produit->nom }}</h1>

    <a href="{{ route('produits.index') }}"><button class="btn btn-secondary">Retourner</button></a>

    <p>ID du produit: {{ $produit->id }}</p>
    <p>Nom du fournisseur : {{ $produit->fournisseur->nom }}</p>
    <p>Désignation : {{ $produit->designation }}</p>
    <p>Créé le : {{ $produit->created_at }}</p>
    <p>Modifié le : {{ $produit->updated_at }}</p>

    <a href="{{ route('produits.edit', $produit->id) }}"><button class="btn btn-primary">Modifier</button></a>
    <br>

    <form method="post" action="{{ route('produits.destroy', $produit->id) }}">
        @csrf
        @method('DELETE')
        <br>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
@endsection
