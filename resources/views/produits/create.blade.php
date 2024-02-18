<!-- resources/views/produits/create.blade.php -->

@extends('layouts.app')

@section('content')
<br>
    <a href="{{ route('produits.index')}}"><button class="btn btn-secondary">Retourner</button></a></td>

    <h1>Créer un produit</h1>

    @if (session('error_fournisseur'))
        <div class="alert alert-danger">
            {{ session('error_fournisseur') }}
        </div>
    @endif

    <form action="{{ route('produits.store') }}" method="post">
        @csrf
    
        <div class="mb-3">
            <label for="fournisseur_nom" class="form-label">Nom du fournisseur :</label>
            <input type="hidden" id="idFournisseur">
            <input type="text" id="autocompleteInput" name="fournisseur_nom" class="form-control  @error('fournisseur_nom') is-invalid @enderror" oninput="autocomplete_fournisseur()" >
            <div id="autocompleteResults"></div>
            @error('fournisseur_nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="designation" class="form-label">Désignation :</label>
            <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror">
            @error('designation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <script>
        const autocompleteInput = document.getElementById('autocompleteInput');
        const autocompleteResults = document.getElementById('autocompleteResults');
        const idFournisseur = document.getElementById('idFournisseur');

        function autocomplete_fournisseur()
        {
            const query = autocompleteInput.value;

            fetch(`{{ route('bdc.autocompleteFournisseur') }}?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    autocompleteResults.innerHTML = '';

                    data.forEach(result => {
                        const option = document.createElement('div');
                        option.textContent = result.nom;
                        option.addEventListener('click', function () {
                            idFournisseur.value = result.id;
                            autocompleteInput.value = result.nom;
                            autocompleteResults.innerHTML = '';
                        });

                        autocompleteResults.appendChild(option);
                    });
                    console.log(data);
                });
        }
</script>
    
@endsection
