<!-- resources/views/users/create.blade.php -->

@extends('layouts.app')

@section('content')
<br>
    <a href="{{ route('users.index')}}"><button class="btn btn-secondary">Retourner</button></a></td>

    <h1>Créer un utilisateur</h1>

    <form action="{{ route('users.store') }}" method="post">
        @csrf
    
        <div class="mb-3">
            <label for="service" class="form-label">Service :</label>
            <input type="text" name="service" class="form-control @error('service') is-invalid @enderror">
            @error('service')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="agence" class="form-label">Agence :</label>
            <input type="text" name="agence" class="form-control @error('agence') is-invalid @enderror">
            @error('agence')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    
@endsection
