<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Modifier l'utilisateur {{ $user->name }}</h1>

    <a href="{{ route('users.show', $user->id) }}"><button class="btn btn-secondary">Retourner</button></a>

    <form method="post" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom :</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ $user->password }}">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
