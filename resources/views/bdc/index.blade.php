@extends('layouts.app')

@section('content')

    <style>
        .logo{
            margin-left: 93%;
            margin-top: 20px;
        }
        .titre
        {
            display: flex;
            flex-direction: row;  
            justify-content: space-between;
        }
        .en-tete
        {
            text-align: left;
        }
        .fournisseur
        {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .result
        {
            font-weight: bold;
            text-decoration: underline;
            letter-spacing: 0.02em;
        }
        .message
        {
            font-size: 14px;
            font-weight: bold;
        }
        .styled-table, .tableau-hafa {
            border-collapse: collapse;
            width: 100%;
        }

        .styled-table, th, td {
            border: 1px solid black;
        }

        .styled-table th, .styled-table td {
            font-size: 15px;
            height: 20px;
            text-align: center;
            font-weight: bold;
        }
        .tableau-hafa th, .tableau-hafa td {
            font-size: 11px;
            height: 12px;
            text-align: center;
            font-weight: bold;
        }

        .lieu_livraison_content
        {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .lieu_livraison
        {
            display: flex;
            flex-direction: column;
            text-align: left;
            font-size: 12px;
            font-weight: bold;
        }
        .signature
        {
            margin-left: 95%;
            width: 100px;
            height: 50px;
        }
        .infos
        {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: solid;

        }
        .infos input, .en-tete input, .fournisseur input
        {
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: solid;
            text-align: center;
            font-weight: bold;
        }
        .dashed_border
        {
            border-top:dashed;
        }
        .partie
        {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly
        }
        .sous-partie
        {
            width: 100px;
            align-items: center;
            text-align: center;
        }
        .footer
        {
            font-size: 12px;
        }
        .lieu_livraison input
        {
            border: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <a href="{{ route('bdc.welcome')}}"><button class="btn btn-secondary">Revenir à la liste des bons de commande</button></a>
    <div style="background-color: white; padding:20px;margin:10px; border-radius:10px;">
        <div class="logo">
            <img src="{{ asset('images/agl_bleu.svg') }}" alt="Logo AGL">
        </div> 
        <div class="titre">
            <h5>DETAILS DU BORDEREAU DE COMMANDE NUMERO {{ $bonDeCommande->numero }}</h5>
            <div class="en-tete">
                N°  <input type="text" class="resultat" value="{{ $bonDeCommande->numero }}" readonly> <br>
                Date<input type="text" class="resultat" value="{{ $bonDeCommande->date }}" readonly> <br>
            </div>
        </div>
        <div class="fournisseur">
            <p>Fournisseur<input type="text" class="resultat" value=" {{ $bonDeCommande->detailsBonDeCommande->first()->produit->fournisseur->nom }}" readonly></p>
            <p class="ref_iris">REF IRIS <input type="text" class="resultat" value="{{ $bonDeCommande->detailsBonDeCommande->first()->produit->fournisseur->reference_iris }}" readonly></p>
        </div>
        
        <p class="message">
            Nous vous prions de joindre les références de cette commande à la facture. <br>
            D'envoyer cette dernière au service tracking fournisseur du site destinataire en 2 exemplaires. <br>
            Avec nos références fiscales complètes.
        </p> 
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Quantité</th>
                    <th>Désignation</th>
                    <th>PU HT</th>
                    <th>TOTAL HT</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 8; $i++)
                    <tr class="table-row">
                        <td>{{ $i < count($bonDeCommande->detailsBonDeCommande) ? $bonDeCommande->detailsBonDeCommande[$i]->quantite : '' }}</td>
                        <td>{{ $i < count($bonDeCommande->detailsBonDeCommande) ? $bonDeCommande->detailsBonDeCommande[$i]->produit->designation : '' }}</td>
                        <td>{{ $i < count($bonDeCommande->detailsBonDeCommande) ? $bonDeCommande->detailsBonDeCommande[$i]->prix_ht : '' }}</td>
                        <td>{{ $i < count($bonDeCommande->detailsBonDeCommande) ? $bonDeCommande->detailsBonDeCommande[$i]->total_ht : '' }}</td>
                    </tr>
                @endfor
                <tr>
                    <td></td>
                    <th>TOTAL (ou à reporter)</th>
                    <td></td>
                    <td>{{$bonDeCommande->grand_total_ht}} Ar HT </td>
                </tr>
                <tr>
                    <td></td>
                    <th>TVA</th>
                    <td>{{$bonDeCommande->total_tva}} Ar</td>
                    <td>{{$bonDeCommande->grand_total_ttc}} Ar TTC </td>
                </tr>
            </tbody>
        </table>
        
        <div class="signature">
            <p><strong>Signature</strong></p>
    
        </div>
        <p><strong>Lieu de livraison</strong></p> <input id="lieu_livraison" type="hidden" value="{{ $bonDeCommande->lieu_livraison }}">
        <div class="lieu_livraison_content">
            <div class="lieu_livraison">
                <input type="text" value="Tanjombato" id="tjb" readonly>
                <input type="text" value="Ivato" id="ivt"readonly>
                <input type="text" value="Antanimena" id="antanimena"readonly>
            </div>
            <div class="lieu_livraison">
                <input type="text" value="Toamasina_Log" id="toamasina_log"readonly>
                <input type="text" value="Tamatave" id="tmm"readonly>
                <input type="text" value="Antsirabe" id="Antsirabe"readonly>
            </div>
            <div class="lieu_livraison">
                <input type="text" value="Mahajanga" id="mjn"readonly>
                <input type="text" value="Tolagnaro" id="tolagnaro"readonly>
                <input type="text" value="Toliary" id="toliary"readonly>
            </div>
            <div class="lieu_livraison">
                <input type="text" value="Antsiranana" id="antsiranana"readonly>
                <input type="text" value="Nosy Be" id="nosy_be"readonly>
            </div>
        </div><br>
    
        <p class="message dashed_border">Débours : les prises en charges directes par le client ne donnent pas lieu à une commande sous notre en-tête</p>
        
        <div class="infos">
            <p> <label for="xm">XM</label><input type="text" class="resultat" value="{{$bonDeCommande->xm}}" readonly></p>
            <p> <label for="xt">XT</label><input type="text" class="resultat" value="{{$bonDeCommande->xt}}" readonly></p>
            <p> <label for="418100">418100</label><input type="text" class="resultat" value="" readonly></p>
        </div>
        <div class="infos">
            <p> <label for="um">UM</label><input type="text" class="resultat" value="{{$bonDeCommande->um}}" readonly></p>
            <p> <label for="ou">ou</label></p>
            <p> <label for="dac">DAC</label><input type="text" class="resultat" value="{{$bonDeCommande->tva}}" readonly></p>
        </div>
        <div class="infos">
            <input type="hidden" id="type" value="{{ $bonDeCommande->type }}">
            <p> <label for="charge">CHARGE</label></p>
            <P><input type="checkbox" value="charge" id="charge" readonly></p>
            <p><label for="stock">STOCK</label></p>
            <p><input type="checkbox" value="stock" id="stock" readonly></p>
        </div>
        <table class="tableau-hafa">
            <thead>
                <tr>
                    <th>SITE</th>
                    <input type="hidden" id="site" value="{{$bonDeCommande->site}}">
                    <th>DEPARTEMENT</th>
                    <input type="hidden" id="departemement" value="{{$bonDeCommande->departement}}">
                    <th>DELEGATIONS ET AUTRES</th>
                    <input type="hidden" id="delegations" value="{{$bonDeCommande->delegations}}">
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label><input type="radio" name="site" id="ABE" value="ABE">&nbsp;ABE</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"> <label for="">SHIPPING</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" id="10A01" value="10A01">&nbsp;10A01</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" id="10B01" value="10B01">&nbsp;10B01</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="10T01" id="10T01">&nbsp;10T01</label></div>
                        </div>
                    </td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">BOLLORE STRUCTURE</label></div>
                            <div class="sous-partie"><label><input type="radio" name="delegations" value="MG1605A5" id="MG1605A5">&nbsp;MG1605A5</label></div>
                        </div>    
                    </td>
                </tr>
                <tr>
                    <td><label><input type="radio" name="site" value="DIE" id="DIE">&nbsp;DIE</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">CTM</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="20A01" id="20A01">&nbsp;20A01</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="20B01" id="20B01">&nbsp;20B01</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="20T01" id="20T01">&nbsp;20T01</label></div>
                        </div>
                    </td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">AGL AFRICA</label></div>
                            <div class="sous-partie"><label><input type="radio" name="delegations" value="MG046200" id="MG046200">&nbsp;MG046200</label></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label><input type="radio" name="site" value="FTU" id="FTU">&nbsp;FTU</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">CTA</label></div>
                            <div class="sous-partie"> <label><input type="radio" name="departement" value="30A01" id="30A01">&nbsp;30A01</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="30B01" id="30B01">&nbsp;30B01</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="30A02" id="30A02">&nbsp;30A02</label></div>
                        </div>   
                    </td>
                    <td> </td>
                </tr>
                <tr>
                    <td><label><input type="radio" name="site" value="IVT" id="IVT">&nbsp;IVT</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">BASE LOGISTIQUE</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="15100" id="15100">&nbsp;15100</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="20D01" id="20D01">&nbsp;20D01</label></div>
                            <div class="sous-partie"></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td><label><input type="radio" name="site" id="MJN" value="MJN">&nbsp;MJN</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">NSN</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="40D00" id="40D00">&nbsp;40D00</label></div>
                            <div class="sous-partie"></div>
                            <div class="sous-partie"></div>
                        </div>
                    </td>
                    <td> </td>
                </tr>
                <tr>
                    <td><label><input type="radio" name="site" value="NSB" id="NSB">&nbsp;NSB</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">DG</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="70B01" id="70B01">&nbsp;70B01</label></div>
                            <div class="sous-partie"></div>
                            <div class="sous-partie"></div>
                        </div>
                    </td>
                    <td> </td>
                </tr>
                <tr>
                    <td><label><input type="radio" name="site" value="TJB" id="TJB">&nbsp;TJB</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"> <label for="">AGENCE</label></div>
                            <div class="sous-partie"> <label><input type="radio" name="departement" value="70C01" id="70C01">&nbsp;70C01</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="70C03" id="70C03">&nbsp;70C03</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="70C04" id="70C04">&nbsp;70C04</label></div>
                        </div>
                    </td>
                    <td> </td>
                </tr>
                <tr>
                    <td><label><input type="radio" name="site" value="TMM" id="TMM">&nbsp;TMM</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">DF</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="70E01" id="70E01">&nbsp;70E01</label></div>
                            <div class="sous-partie"></div>
                            <div class="sous-partie"></div>
                        </div>                   
                    </td>
                    <td>AUTRES (à préciser:)</td>
                </tr>
                <tr>
                    <td><label><input type="radio" name="site" id="TUL" value="TUL">&nbsp;TUL</label><br></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">INFORMATIQUE</label></div>
                            <div class="sous-partie"> <label><input type="radio" name="departement" value="70F010" id="70F010">&nbsp;70F010</label></div>
                            <div class="sous-partie"></div>
                            <div class="sous-partie"></div>
                        </div>
                    </td>
                    <td>{{$bonDeCommande->autres}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">PERSONNEL</label></div>
                            <div class="sous-partie"> <label><input type="radio" name="departement" value="70G01" id="70G01">&nbsp;70G01</label></div>
                            <div class="sous-partie"></div>
                            <div class="sous-partie"></div>
                        </div>
                    </td>
                    <td> </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="partie">
                            <div class="sous-partie"><label for="">COMMERCIAL</label></div>
                            <div class="sous-partie"><label><input type="radio" name="departement" value="20T00" id="20T00">&nbsp;20T00</label></div>
                            <div class="sous-partie"></div>
                            <div class="sous-partie"></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <footer>
            <div class="footer">
                Africa Global Logistics Madagascar <br>
                R.C.S. 2001 B 00022 du 30/05/2001 - Stat: 52297 31 1967 0 00002 du 23/06/2023 - N.I.F. : 0000020309 du 10/06/1970 <br>
                Siège : Rue du Capitaine Schoël - Ampasimazava - B.P 411 TOAMASINA 501 <br>
                Tél : +261 20 22 461 09/ +261 20 53 471 09 - aglgroup.com <br>
                E-mail: MG003-agl.madagascar@aglgroup.com <br> 
                Agences : Antananarivo - Ivato - Antsirabe - Toamasina - Mahajanga - Antsiranana - Nosy Be - Toliary - Tolagnaro - Antalaha <br>
                <b>Africa Global Logistics / AGL.MDG.PUR.F.0122 Bordereau de commande / V05 du {{ $bonDeCommande->date }}</b>
            </div>
        </footer>
    </div>

    <script>
        lieu_livraison = document.getElementById('lieu_livraison').value;
        type = document.getElementById('type').value;
        site = document.getElementById('site').value;
        departement = document.getElementById('departemement').value;
        delegations = document.getElementById('delegations').value;
        if(lieu_livraison == 'Tanjombato')
        {
                document.getElementById('tjb').style.border = 'solid';
            }
            else if(lieu_livraison == 'Ivato')
            {
                document.getElementById('ivt').style.border = 'solid';
            }
            else if(lieu_livraison == 'Antanimena')
            {
                document.getElementById('antanimena').style.border = 'solid';
            }
            else if(lieu_livraison == 'Toamasina_Log')
            {
                document.getElementById('toamasina_log').style.border = 'solid';
            }
            else if(lieu_livraison == 'Tamatave')
            {
                document.getElementById('tmm').style.border = 'solid';
            }
            else if(lieu_livraison == 'Antsirabe')
            {
                document.getElementById('Antsirabe').style.border = 'solid';
            }
            else if(lieu_livraison == 'Mahajanga')
            {
                document.getElementById('mjn').style.border = 'solid';
            }
            else if(lieu_livraison == 'Tolagnaro')
            {
                document.getElementById('tolagnaro').style.border = 'solid';
            }
            else if(lieu_livraison == 'Toliary')
            {
                document.getElementById('toliary').style.border = 'solid';
            }
            else if(lieu_livraison == 'Antsiranana')
            {
                document.getElementById('antsiranana').style.border = 'solid';
            }
            else if(lieu_livraison == 'Nosy Be')
            {
                document.getElementById('nosy_be').style.border = 'solid'; 
        }
        if(type == 'charge')
        {
                document.getElementById('charge').checked = true;
            }
            else if(type == 'stock')
            {
                document.getElementById('stock').checked = true;
        }

        if(site == 'ABE')
        {
                document.getElementById('ABE').checked = true;
            }
            else if(site == 'DIE')
            {
                document.getElementById('DIE').checked = true;
            }
            else if(site == 'FTU')
            {
                document.getElementById('FTU').checked = true;
            }
            else if(site == 'IVT')
            {
                document.getElementById('IVT').checked = true;
            }
            else if(site == 'MJN')
            {
                document.getElementById('MJN').checked = true;
            }
            else if(site == 'NSB')
            {
                document.getElementById('NSB').checked = true;
            }
            else if(site == 'TJB')
            {
                document.getElementById('TJB').checked = true;
            }
            else if(site == 'TMM')
            {
                document.getElementById('TMM').checked = true;
            }
            else if(site == 'TUL')
            {
                document.getElementById('TUL').checked = true;
        }

        if(departement == '10A01')
        {
                document.getElementById('10A01').checked = true;
            }
            else  if(departement == '20A01')
            {
                document.getElementById('20A01').checked = true;
            } else  if(departement == '30A01')
            {
                document.getElementById('30A01').checked = true;
            }
            else  if(departement == '15100')
            {
                document.getElementById('15100').checked = true;
            }
            else  if(departement == '40D00')
            {
                document.getElementById('40D00').checked = true;
            }
            else  if(departement == '70B01')
            {
                document.getElementById('70B01').checked = true;
            }
            else  if(departement == '70C01')
            {
                document.getElementById('70C01').checked = true;
            }
            else  if(departement == '70E01')
            {
                document.getElementById('70E01').checked = true;
            }
            else  if(departement == '70F010')
            {
                document.getElementById('70F010').checked = true;
            }
            else  if(departement == '70G01')
            {
                document.getElementById('70G01').checked = true;
            }
            else  if(departement == '20T00')
            {
                document.getElementById('20T00').checked = true;
            }
            else  if(departement == '10B01')
            {
                document.getElementById('10B01').checked = true;
            }
            else  if(departement == '20B01')
            {
                document.getElementById('20B01').checked = true;
            }
            else  if(departement == '30B01')
            {
                document.getElementById('30B01').checked = true;
            }
            else  if(departement == '20D01')
            {
                document.getElementById('20D01').checked = true;
            }
            else  if(departement == '70C03')
            {
                document.getElementById('70C03').checked = true;
            }
            else  if(departement == '10T01')
            {
                document.getElementById('10T01').checked = true;
            }
            else  if(departement == '20T01')
            {
                document.getElementById('20T01').checked = true;
            }
            else  if(departement == '30A02')
            {
                document.getElementById('30A02').checked = true;
            }
            else  if(departement == '70C04')
            {
                document.getElementById('70C04').checked = true;
        }

        if(delegations == 'MG1605A5')
        {
            document.getElementById('MG1605A5').checked = true;
        }
        else   if(delegations == ' MG046200')
        {
            document.getElementById(' MG046200').checked = true;
        }

    </script>
</body>
</html>
@endsection
