<!-- affichage des listes des utilisateurs -->

@extends('layouts.app')
<style>
    .bouton_ajouter
    {
        background-color: rgb(50, 50, 146);
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    .bouton_details
    {
        background-color: rgb(255, 241, 111);
        color: rgb(8, 8, 8);
        padding: 10px;
        border-radius: 5px;
    }
</style>
@section('content')


    <h3>Liste des bons de commande</h3>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <input id="searchInput" type="text" placeholder="Rechercher un bon de commande..." class="form-control">
    <br>
    <a href="{{ route('bdc.create') }}"><button class="bouton_ajouter">Effectuer un bon de commande</button></a>
    <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>Agence</th>
                    <th>Fournisseur</th>
                    <th>Numéro</th>
                    <th>Date</th>
                    <th>Lieu de livraison</th>
                    <th>Grand total HT</th>
                    <th>Grand total TTC</th>
                    <th>Grand total avec remise</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="searchResults">
                @foreach($bdcs as $bdc)
                    <tr>
                        <td>{{ $bdc->id }}</td>
                        <td> {{ $bdc->user->service }}</td>
                        <td> {{ $bdc->user->agence }}</td>
                        <td>{{ $bdc->fournisseur->nom }}</td>
                        <td>{{ $bdc->numero }}</td>
                        <td>{{ $bdc->date }}</td>
                        <td>{{ $bdc->lieu_livraison }}</td>
                        <td>{{ $bdc->grand_total_ht }}</td>
                        <td>{{ $bdc->grand_total_ttc }}</td>
                        <td>{{ $bdc->grand_total_remise }}</td>
                        <td><a href="{{ route('bdc.show', $bdc->id) }}"><button class="bouton_details">Détails</button></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    <script>
        const bdcs = @json($bdcs->toArray());
        //console.log(bdcs);
        const updateSearchResults = (searchTerm) => {
            searchResults.innerHTML = ''; // Réinitialiser le contenu

            bdcs.forEach(bdc => {
                const userFullName = (bdc.user && bdc.user.name) ? bdc.user.name.toLowerCase() : '';
                const fournisseurNom = (bdc.fournisseur && bdc.fournisseur.nom) ? bdc.fournisseur.nom.toLowerCase() : '';

                if (
                    bdc.id.toString().includes(searchTerm) ||
                    bdc.numero.includes(searchTerm) ||
                    bdc.date.includes(searchTerm) ||
                    userFullName.includes(searchTerm) ||
                    fournisseurNom.includes(searchTerm) ||
                    bdc.lieu_livraison.toLowerCase().includes(searchTerm) || 
                    bdc.grand_total_ht.toString().includes(searchTerm) || 
                    bdc.grand_total_ttc.toString().includes(searchTerm) ||
                    bdc.grand_total_remise.toString().includes(searchTerm)
                )
                {
                    // Ajouter le résultat filtré au contenu
                    searchResults.innerHTML += `
                        <tr>
                            <td>${bdc.id}</td>
                            <td>${userFullName}</td>
                            <td>${fournisseurNom}</td>
                            <td>${bdc.numero}</td>
                            <td>${bdc.date}</td>
                            <td>${bdc.lieu_livraison}</td>
                            <td>${bdc.grand_total_ht}</td>
                            <td>${bdc.grand_total_ttc}</td>
                            <td>${bdc.grand_total_remise}</td>
                            <td><button onclick="details(${bdc.id})" class="details-btn bouton_details">Détails</button></td>
                        </tr>
                    `;
                };
            });
        };

        // Appeler la fonction une première fois pour afficher tous les résultats au chargement initial
        updateSearchResults('');


        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', (event) => {
            const searchTerm = event.target.value.toLowerCase();
            updateSearchResults(searchTerm);
        });

        
        function details(bdcId)
        {
            const routeUrl = `{{ route('bdc.show', ':bdcId') }}`.replace(':bdcId', bdcId);
            window.location.href = routeUrl;
        }
    

    </script>
@endsection
