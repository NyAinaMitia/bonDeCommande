<!-- affichage des listes des utilisateurs -->

@extends('layouts.app')

@section('content')
    <h1>Liste des utilisateurs</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <input id="searchInput" type="text" placeholder="Rechercher un utilisateur..." class="form-control">
    <br>
    <a href="{{ route('users.create') }}"><button class="btn btn-primary">Créer</button></a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>Agence</th>
                    <th>Créé le</th>
                    <th>Modifié le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="searchResults">
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->service }}</td>
                        <td>{{ $user->agence }}</td>
                        <td>{{ $user->created_at}}</td>
                        <td>{{ $user->updated_at}}</td>
                        <td><a href="{{ route('users.show', $user->id) }}"><button class="btn btn-warning">Détails</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    <script>
        const users = @json($users->toArray());

        const updateSearchResults = (searchTerm) => {
            const filteredResults = users.filter(user => {
                return Object.values(user).some(value => {
                    return typeof value === 'string' && value.toLowerCase().includes(searchTerm);
                });
            });

            searchResults.innerHTML = '';
            filteredResults.forEach(user => {
                searchResults.innerHTML += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.created_at}</td>
                        <td>${user.updated_at}</td>
                        <td><button onclick="details(${user.id})" class="details-btn btn btn-warning">Détails</button></td>
                    </tr>
                `;
            });
        };

        // Écouter les changements dans l'input de recherche
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', (event) => {
            const searchTerm = event.target.value.toLowerCase();
            updateSearchResults(searchTerm);
        });
        // Écoutez les clics sur les boutons de détails
        function details(userId)
        {
            const routeUrl = `{{ route('users.show', ':userId') }}`.replace(':userId', userId);
            window.location.href = routeUrl;
        }
    

    </script>
@endsection
