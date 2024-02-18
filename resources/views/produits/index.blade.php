<!-- affichage des listes des produits -->

@extends('layouts.app')

@section('content')
    <h1>Liste des produits</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <input id="searchInput" type="text" placeholder="Rechercher un produit..." class="form-control">
    <br>
    <a href="{{ route('produits.create') }}"><button class="btn btn-primary">Créer</button></a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du fournisseur</th>
                    <th>Désignation</th>
                    <th>Créé le</th>
                    <th>Modifié le</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="searchResults">
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->id }}</td>
                        <td>{{ $produit->fournisseur->nom }}</td>
                        <td>{{ $produit->designation }}</td>
                        <td>{{ $produit->created_at}}</td>
                        <td>{{ $produit->updated_at}}</td>
                        <td><a href="{{ route('produits.show', $produit->id) }}"><button class="btn btn-warning">Détails</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    <script>
        const produits = @json($produits->toArray());

        const updateSearchResults = (searchTerm) => {
            const filteredResults = produits.filter(produit => {
                return (
                    Object.values(produit).some(value => {
                        return (
                            typeof value === 'string' && value.toLowerCase().includes(searchTerm)
                        );
                    }) ||
                    (produit.fournisseur.nom &&
                        produit.fournisseur.nom.toLowerCase().includes(searchTerm))
                );
            });

            searchResults.innerHTML = '';
            filteredResults.forEach(produit => {
                searchResults.innerHTML += `
                    <tr>
                        <td>${produit.id}</td>
                        <td>${produit.fournisseur.nom}</td>
                        <td>${produit.designation}</td>
                        <td>${produit.created_at}</td>
                        <td>${produit.updated_at}</td>
                        <td><button onclick="details(${produit.id})" class="details-btn btn btn-warning">Détails</button></td>
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
        function details(produitId)
        {
            const routeUrl = `{{ route('produits.show', ':produitId') }}`.replace(':produitId', produitId);
            window.location.href = routeUrl;
        }
        
    </script>
@endsection
