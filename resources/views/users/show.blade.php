<!-- resources/views/users/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Détails de l'utilisateur {{ $user->name }}</h1>

    <a href="{{ route('users.index') }}"><button class="btn btn-secondary">Retourner</button></a>

    <p>Nom : {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>Password : {{ $user->password }}</p>

    <a href="{{ route('users.edit', $user->id) }}"><button class="btn btn-primary">Modifier</button></a>
    <br>

    <form method="post" action="{{ route('users.destroy', $user->id) }}">
        @csrf
        @method('DELETE')
        <br>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
@endsection
