<!-- resources/views/bdc/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="">
        
        <a href="{{ route('bdc.welcome')}}"><button class="btn btn-secondary">Revenir à la liste des bons de commande</button></a>
        <h1 class="mt-5">Créer un Bon de Commande</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bdc.store')}}" method="post">
            @csrf
            <input type="text" name="user_id" placeholder="ID de l'utilisateur">

            <div class="mb-3">
                <label for="fournisseur" class="form-label">Fournisseur :</label>
                <input type="hidden" id="idFournisseur" name="fournisseur_id">
                <input type="text" name="fournisseur" class="form-control" id="autocompleteInput" required oninput="autocomplete_fournisseur()">
                <div id="autocompleteResults"></div>
                <label for="reference_iris" class="form-label">REF_IRIS : </label><span id="reference_iris"></span>
            </div>

            <div class="mb-3">
                <label for="devise" class="form-label">Devise :</label>
                <select name="devise" id="" required class="form-select">
                    <option value="ariary">Ariary</option>
                    <option value="euro">Euro</option>
                    <option value="dollars">Dollars</option>
                </select>
            </div>

            <button class="btn btn-info" type="button" onclick="addRow()">Ajouter une ligne dans le tableau</button> <br><br>
            <label class="form-check-label" for="remise">Tout sélectionner avec remise:</label>
            <div class="input-group mb-3">
                <br>
                <div class="input-group-text">
                  <input class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input" id="remiseCheckbox" onchange="activateRemise()">
                </div>
                <input type="number" min="1" max="100" class="form-control" placeholder="en %" disabled id="pourcentageRemiseGlobale" oninput="activateRemise()">
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Quantité</th>
                        <th>Désignation</th>
                        <th>Prix unitaire</th>
                        <th>Total HT</th>
                        <th>TVA (20 %)</th>
                        <th>Total TTC</th>
                        <th>Remise</th>
                        <th>Total avec Remise</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td><input type="number" name="quantite[]" id="quantite"  required class="form-control quantite" oninput="updateFields(this)"></td>
                        <td>
                            <input type="text" name="designation[]" id="inputDesignation" class="form-control designation" required oninput="autocomplete_designation(this)">
                            <div id="autoCompleteDesignation"></div>
                        </td>
                        <td><input type="number" name="prix_unitaire[]" id="prix-unitaire"  class="form-control prix-unitaire" required oninput="updateFields(this)"></td>
                        <td><input type="text" name="total_ht[]" class="form-control total-ht" id="total-ht" readonly></td>
                        <td>
                            <input type="checkbox" id="tva_checked" class="tva" onchange="updateFields(this)">
                            <input type="hidden" name="tva[]" class="montant_tva">
                        </td>
                        <td><input type="number" name="total_ttc[]" id="total-ttc" class="form-control total-ttc" readonly></td>
                        <td><input type="number" name="pourcentage_remise[]" class="form-control pourcentageRemise" placeholder="en %" id="pourcentageRemise" oninput="updateFields(this)" min="1" max="100"></td>
                        <td><input type="number" name="total_avec_remise[]" class="form-control total-remise" readonly></td>
                        <td class="cancel-cell"></td>                        
                    </tr>
                    <tr class="grand-total-row">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Grand total HT</th>
                        <th>Montant total TVA</th>
                        <th>Grand total TTC</th>
                        <th>Montant total des remises</th>
                        <th>Grand total avec remise</th>
                    </tr>
                    <tr class="grand-total-row">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><input type="text" name="grand_total_ht" class="form-control" id="grand-total-ht" readonly></th>
                        <th><input type="text" name="total_tva" class="form-control" id="total-tva" readonly></th>
                        <th><input type="number" name="grand_total_ttc" id="grand-total-ttc" class="form-control" readonly></th>
                        <th><input type="number" name="total_remise" id="total-remise" class="form-control" readonly></th>
                        <th><input type="number" name="grand_total_remise" id="grand-total-remise" class="form-control" readonly></th>
                    </tr>
                    
                </tbody>
            </table>

             <div class="mb-3">
                <label for="lieu_livraison" class="form-label">Lieu de livraison :</label>
                <select name="lieu_livraison" id="" class="form-select">
                    <option value="Tanjombato">Tanjombato</option>
                    <option value="Ivato">Ivato</option>
                    <option value="Antanimena">Antanimena</option>
                    <option value="Toamasina_Log">Toamasina Log</option>
                    <option value="Tamatave">Tamatave</option>
                    <option value="Antsirabe">Antsirabe</option>
                    <option value="Mahajanga">Mahajanga</option>
                    <option value="Tolagnaro">Tolagnaro</option>
                    <option value="Toliary">Toliary</option>
                    <option value="Antsiranana">Antsiranana</option>
                    <option value="Nosy_Be">Nosy Be</option>
                </select>
            </div>

            <div class="d-flex">
                <div class="mr-3 d-flex align-items-center">
                    <label for="xm" class="form-label mr-2">XM</label>
                    <input type="text" name="xm" id="xm" class="form-control">
                </div>&nbsp;&nbsp;
                <div class="mr-3 d-flex align-items-center">
                    <label for="xt" class="form-label mr-2">XT</label>
                    <input type="text" name="xt" id="xt" class="form-control">
                </div>&nbsp;&nbsp;
                <div class="d-flex align-items-center">
                    <label for="418100" class="form-label mr-2"> 418100</label>
                    <input type="text" name="418100" id="418100" class="form-control">
                </div>&nbsp;&nbsp;
            </div><br><br>

            <div class="d-flex">
                <div class="mr-3 d-flex align-items-center">
                    <label for="um" class="form-label mr-2">UM</label>
                    <input type="text" name="um" id="um" class="form-control">
                </div>&nbsp;&nbsp;
                <div class="d-flex align-items-center">
                    <label for="" class="form-label mr-2">ou</label>
                </div>&nbsp;&nbsp;
                <div class="mr-3 d-flex align-items-center">
                    <label for="dac" class="form-label mr-2">DAC</label>
                    <input type="text" name="dac" id="dac" class="form-control">
                </div>
            </div><br><br>

            <div class="d-flex">
                    <label><input class="form-check-input" type="radio" name="type" value="charge" id="charge"> CHARGE </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input class="form-check-input" type="radio" name="type" value="stock" id="stock"> STOCK</label>
            </div><br><br>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SITE</th>
                        <th>DEPARTEMENT</th>
                        <th>DELEGATIONS ET AUTRES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label><input type="radio" name="site" value="ABE">&nbsp;ABE</label><br>
                            <label><input type="radio" name="site" value="DIE">&nbsp;DIE</label><br>
                            <label><input type="radio" name="site" value="FTU">&nbsp;FTU</label><br>
                            <label><input type="radio" name="site" value="IVT">&nbsp;IVT</label><br>
                            <label><input type="radio" name="site" value="MJN">&nbsp;MJN</label><br>
                            <label><input type="radio" name="site" value="NSB">&nbsp;NSB</label><br>
                            <label><input type="radio" name="site" value="TJB">&nbsp;TJB</label><br>
                            <label><input type="radio" name="site" value="TMM">&nbsp;TMM</label><br>
                            <label><input type="radio" name="site" value="TUL">&nbsp;TUL</label><br>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction:row;justify-content:space-evenly;">
                                <div>
                                    <label for="">SHIPPING</label><br>
                                    <label for="">CTM</label><br>
                                    <label for="">CTA</label><br>
                                    <label for="">BASE LOGISTIQUE</label><br>
                                    <label for="">NSN</label><br>
                                    <label for="">DG</label><br>
                                    <label for="">AGENCE</label><br>
                                    <label for="">DF</label><br>
                                    <label for="">INFORMATIQUE</label><br>
                                    <label for="">PERSONNEL</label><br>
                                    <label for="">COMERCIAL</label>
                                </div>
                                <div>
                                    <label><input type="radio" name="departement" value="10A01">&nbsp;10A01</label><br>
                                    <label><input type="radio" name="departement" value="20A01">&nbsp;20A01</label><br>
                                    <label><input type="radio" name="departement" value="30A01">&nbsp;30A01</label><br>
                                    <label><input type="radio" name="departement" value="15100">&nbsp;15100</label><br>
                                    <label><input type="radio" name="departement" value="40D00">&nbsp;40D00</label><br>
                                    <label><input type="radio" name="departement" value="70B01">&nbsp;70B01</label><br>
                                    <label><input type="radio" name="departement" value="70C01">&nbsp;70C01</label><br>
                                    <label><input type="radio" name="departement" value="70E01">&nbsp;70E01</label><br>
                                    <label><input type="radio" name="departement" value="70F01">&nbsp;70F01</label><br>
                                    <label><input type="radio" name="departement" value="70G01">&nbsp;70G01</label><br>
                                    <label><input type="radio" name="departement" value="20T00">&nbsp;20T00</label><br>
                                </div>
                                <div>
                                    <label><input type="radio" name="departement" value="10B01">&nbsp;10B01</label><br>
                                    <label><input type="radio" name="departement" value="20B01">&nbsp;20B01</label><br>
                                    <label><input type="radio" name="departement" value="30B01">&nbsp;30B01</label><br>
                                    <label><input type="radio" name="departement" value="20D01">&nbsp;20D01</label><br>
                                    <label></label><br>
                                    <label></label><br>
                                    <label><input type="radio" name="departement" value="70C03">&nbsp;70C03</label><br>
                                    <label></label><br>
                                    <label></label><br>
                                    <label></label><br>
                                    <label></label><br>
                                </div>
                                <div>
                                    <label><input type="radio" name="departement" value="10T01">&nbsp;10T01</label><br>
                                    <label><input type="radio" name="departement" value="20T01">&nbsp;20T01</label><br>
                                    <label><input type="radio" name="departement" value="30B01">&nbsp;30B01</label><br>
                                    <label><input type="radio" name="departement" value="30A02">&nbsp;30A02</label><br>
                                    <label></label><br>
                                    <label></label><br>
                                    <label><input type="radio" name="departement" value="70C04">&nbsp;70C04</label><br>
                                    <label></label><br>
                                    <label></label><br>
                                    <label></label><br>
                                    <label></label><br>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction:row;justify-content:space-evenly;">
                                <div>
                                    <label for="">BOLLORE STRUCTURE</label><br>
                                    <label for="">AGL AFRICA</label><br>
                                    <label for=""></label><br>
                                    <label for=""></label><br>
                                    <label for=""></label><br>
                                    <label for=""></label><br>
                                    <label for="">AUTRES (à préciser)</label><br>
                                    <textarea name="autres" id="" cols="50" rows="3"></textarea>
                                </div>
                                <div>
                                    <label><input type="radio" name="delegations" value="MG1605A5">&nbsp;MG1605A5</label><br>
                                    <label><input type="radio" name="delegations" value="MG046200">&nbsp;MG046200</label><br>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div style="display: flex; flex-direction:row; justify-content:space-evenly">
                <button type="submit" class="btn btn-success">Confirmer</button>
                <a href="{{ route('bdc.create')}}" class="btn btn-danger">Réinitialiser</a>
            </div><br>
        </form>
    </div>
    <script src="{{ asset('js/bonDeCommande.js') }}"></script>
    <script>
            const autocompleteInput = document.getElementById('autocompleteInput');
            const autocompleteResults = document.getElementById('autocompleteResults');
            const idFournisseur = document.getElementById('idFournisseur');
            const reference_iris = document.getElementById('reference_iris');

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
                                reference_iris.textContent = result.reference_iris;
                                autocompleteResults.innerHTML = '';
                            });

                            autocompleteResults.appendChild(option);
                        });
                        console.log(data);
                    });
            }

            function autocomplete_designation(champ) {
                const row = champ.closest('.table-row');
                const inputDesignation = row.querySelector('#inputDesignation');
                const autocompleteDesignation = row.querySelector('#autoCompleteDesignation');
                const query = inputDesignation.value;
                const fournisseurId = encodeURIComponent(idFournisseur.value);

                fetch(`{{ route('bdc.autocompleteDesignation') }}?query=${query}&fournisseur_id=${fournisseurId}`)
                    .then(response => response.json())
                    .then(data => {
                        autocompleteDesignation.innerHTML = '';

                        data.forEach(result => {
                            const option = document.createElement('div');
                            option.textContent = result.designation;
                            option.addEventListener('click', function () {
                                inputDesignation.value = result.designation;
                                autocompleteDesignation.innerHTML = '';
                            });

                            autocompleteDesignation.appendChild(option);
                        });
                        console.log(data);
                    })
                    .catch(error => console.error('Erreur fetch :', error));
            }
    </script>
@endsection

