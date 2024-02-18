<!-- affichage des listes des fournisseurs -->

@extends('layouts.app')

@section('content')
    <h1>Liste des fournisseurs</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <input id="searchInput" type="text" placeholder="Rechercher un fournisseur..." class="form-control">
    <br>
    <a href="{{ route('fournisseurs.create') }}"><button class="btn btn-primary">Créer</button></a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Référence IRIS</th>
                    <th>Créé le</th>
                    <th>Modifié le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="searchResults">
                @foreach($fournisseurs as $fournisseur)
                    <tr>
                        <td>{{ $fournisseur->id }}</td>
                        <td>{{ $fournisseur->nom }}</td>
                        <td>{{ $fournisseur->reference_iris }}</td>
                        <td>{{ $fournisseur->created_at}}</td>
                        <td>{{ $fournisseur->updated_at}}</td>
                        <td><a href="{{ route('fournisseurs.show', $fournisseur->id) }}"><button class="btn btn-warning">Détails</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    <script>
        const fournisseurs = @json($fournisseurs->toArray());

        const updateSearchResults = (searchTerm) => {
            const filteredResults = fournisseurs.filter(fournisseur => {
                return Object.values(fournisseur).some(value => {
                    return typeof value === 'string' && value.toLowerCase().includes(searchTerm);
                });
            });

            searchResults.innerHTML = '';
            filteredResults.forEach(fournisseur => {
                searchResults.innerHTML += `
                    <tr>
                        <td>${fournisseur.id}</td>
                        <td>${fournisseur.nom}</td>
                        <td>${fournisseur.reference_iris}</td>
                        <td>${fournisseur.created_at}</td>
                        <td>${fournisseur.updated_at}</td>
                        <td><button onclick="details(${fournisseur.id})" class="details-btn btn btn-warning">Détails</button></td>
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
        function details(fournisseurId)
        {
            const routeUrl = `{{ route('fournisseurs.show', ':fournisseurId') }}`.replace(':fournisseurId', fournisseurId);
            window.location.href = routeUrl;
        }

    </script>
@endsection
