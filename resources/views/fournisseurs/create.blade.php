<!-- resources/views/fournisseurs/create.blade.php -->

@extends('layouts.app')

@section('content')
<br>
    <a href="{{ route('fournisseurs.index')}}"><button class="btn btn-secondary">Retourner</button></a></td>

    <h1>Créer un fournisseur</h1>

    <form action="{{ route('fournisseurs.store') }}" method="post">
        @csrf
    
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror">
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="reference_iris" class="form-label">Référence IRIS :</label>
            <input type="text" name="reference_iris" class="form-control @error('reference_iris') is-invalid @enderror">
            @error('reference_iris')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    
@endsection
