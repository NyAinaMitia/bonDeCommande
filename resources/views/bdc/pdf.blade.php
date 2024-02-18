<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BonDeCommande_ {{ $bonDeCommande->numero }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .logo {
            margin-left: 550px;
            width: 50px;
            height: 50px;

        }

        .dashed_border {
            border-top: dashed;
        }

        .en-tete {
            margin-left: 400px;
            text-align: left;
            position: absolute;
            top: 80px;
        }

        .infos-en-tete {
            margin-left: 470px;
            position: absolute;
            top: 80px;
            text-align: left;
        }

        .signature {
            position: absolute;
            margin-left: 550px;
            top: 460px;
        }

        .titre input,
        .fournisseur input {
            border-left: none;
            border-right: none;
            border-top: none;
            border-bottom: solid;
            font-weight: bold;
            text-align: center;
        }

        .fournisseur {
            position: absolute;
            top: 125px;
            font-size: 14px;
        }

        .titre {
            font-size: 14px;
        }

        .message {
            position: absolute;
            top: 170px;
            font-size: 12px;
            font-weight: bold;
        }

        .styled-table {
            position: absolute;
            top: 240px;
            font-size: 14px;
        }

        .styled-table td,
        .styled-table th {
            border: 1px solid black;
            text-align: center;
            height: 23px;
        }

        #quantite {
            width: 100px;
        }

        #designation {
            width: 300px;
        }

        #pu {
            width: 140px;
        }

        #total {
            width: 140px;
        }

        .lieu_livraison {
            position: absolute;
            top: 530px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="images/agl_bleu.svg">
    </div>
    <div class="titre">
        <h5 style="position: absolute; top:80px;">BORDEREAU DE COMMANDE</h5>
        <div class="en-tete">
            N <br>
            Date <br>
            REF IRIS <br>
        </div>
        <div class="infos-en-tete">
            <input type="text" class="resultat" value="{{ $bonDeCommande->numero }}" readonly>
            <input type="text" class="resultat" value="{{ $bonDeCommande->date }}" readonly>
            <input type="text" class="resultat" value="{{ $bonDeCommande->detailsBonDeCommande->first()->produit->fournisseur->reference_iris }}" readonly>
        </div>
    </div>
    <div class="fournisseur">
        <label for="">Fournisseur</label><input type="text" class="resultat" value="{{ $bonDeCommande->detailsBonDeCommande->first()->produit->fournisseur->nom }}" readonly></p>
    </div>
    <p class="message">
        Nous vous prions de joindre les références de cette commande à la facture. <br>
        D'envoyer cette dernière au service tracking fournisseur du site destinataire en 2 exemplaires. <br>
        Avec nos références fiscales complètes.
    </p>

    <table class="styled-table">
        <thead>
            <tr>
                <th id="quantite">QUANTITE</th>
                <th id="designation">DESIGNATION</th>
                <th id="pu">PU HT</th>
                <th id="total">TOTAL HT</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td id="quantite">{{ $i < count($bonDeCommande->detailsBonDeCommande) ? $bonDeCommande->detailsBonDeCommande[$i]->quantite : '' }}</td>
                    <td id="designation">{{ $i < count($bonDeCommande->detailsBonDeCommande) ? $bonDeCommande->detailsBonDeCommande[$i]->produit->designation : '' }}</td>
                    <td id="pu">{{ $i < count($bonDeCommande->detailsBonDeCommande) ? $bonDeCommande->detailsBonDeCommande[$i]->prix_ht : '' }}</td>
                    <td id="total">{{ $i < count($bonDeCommande->detailsBonDeCommande) ? $bonDeCommande->detailsBonDeCommande[$i]->total_ht : '' }}</td>
                </tr>
            @endfor
            <tr>
                <td></td>
                <th>TOTAL (ou à reporter)</th>
                <td></td>
                <td> {{$bonDeCommande->grand_total_ht}} Ar HT </td>
            </tr>
            <tr>
                <td></td>
                <th>TVA</th>
                <td> {{$bonDeCommande->total_tva}} Ar</td>
                <td> {{$bonDeCommande->grand_total_ttc}}  Ar TTC </td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p><strong>Signature</strong></p>
    </div>

    <p class="lieu_livraison"><strong>Lieu de livraison</strong></p>
    <div style="font-size: 11px;">
        @if ($bonDeCommande->lieu_livraison == 'Tanjombato')
            <p style=" position:absolute;top: 550px; border:solid 1px black">Tanjombato</p>
        @else
            <p style=" position:absolute;top: 550px">Tanjombato</p>
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Toamasina Log')
            <p style=" position:absolute;top: 550px;left:200px; border:solid 1px black">Toamasina Log</p>   
        @else
            <p style=" position:absolute;top: 550px;left:200px">Toamasina Log</p>  
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Mahajanga')
            <p style=" position:absolute;top: 550px;left:400px; border:solid 1px black">Mahajanga</p>
        @else
            <p style=" position:absolute;top: 550px;left:400px">Mahajanga</p>
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Antsiranana')
            <p style=" position:absolute;top: 550px;left:600px; border:solid 1px black">Antsiranana</p>
        @else
            <p style=" position:absolute;top: 550px;left:600px">Antsiranana</p>
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Ivato')
            <p style=" position:absolute;top: 565px; border:solid 1px black">Ivato</p>
        @else
            <p style=" position:absolute;top: 565px">Ivato</p>
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Tamatave')
            <p style=" position:absolute;top: 565px;left:200px; border:solid 1px black">Tamatave</p>
        @else
            <p style=" position:absolute;top: 565px;left:200px">Tamatave</p>
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Tolagnaro')
            <p style=" position:absolute;top:565px;left:400px; border:solid 1px black">Tolagnaro</p>
        @else
            <p style=" position:absolute;top:565px;left:400px">Tolagnaro</p>
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Nosy Be')
            <p style=" position:absolute;top: 565px;left:600px; border:solid 1px black">Nosy Be</p>
        @else
            <p style=" position:absolute;top: 565px;left:600px">Nosy Be</p>
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Antanimena')
            <p style=" position:absolute;top: 580px; border:solid 1px black">Antanimena</p>
        @else
            <p style=" position:absolute;top: 580px">Antanimena</p>
        @endif 
        @if ($bonDeCommande->lieu_livraison == 'Antsirabe')
            <p style=" position:absolute;top: 580px;left:200px; border:solid 1px black">Antsirabe</p>
        @else
            <p style=" position:absolute;top: 580px;left:200px">Antsirabe</p>
        @endif
        @if ($bonDeCommande->lieu_livraison == 'Toliara')
            <p style=" position:absolute;top: 580px;left:400px; border:solid 1px black">Toliara</p>
        @else
            <p style=" position:absolute;top: 580px;left:400px">Toliara</p>
        @endif
    </div>     


    <p class="message dashed_border" style="position: absolute; top:610px">Débours : les prises en charges directes par
        le client ne donnent pas lieu à une commande sous notre en-tête &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p style="position:absolute;top:625px; left:50px">XM</p>
    <p style="position:absolute;top:625px; left:250px">XT</p>
    <p style="position:absolute;top:625px; left:500px">418100</p>
    <p style="position:absolute;top:630px; left:70px; border-bottom: 1px solid black; width:150px;height:20px; text-align:center">{{$bonDeCommande->xm}}</p>
    <p style=" height:20px;position:absolute;top:630px; left:270px;border-bottom: 1px solid black;width:150px; text-align:center">{{$bonDeCommande->xt}}</p>
    <p style="height:20px;position:absolute;top:630px; left:550px;border-bottom:1px solid black;width:150px; text-align:center"></p>


    <p style="position: absolute; border-bottom: 1px black solid;top:654px;width:700px;height:1px"></p>

    <p style="position:absolute;top:657px; left:50px">UM</p>
    <p style="position:absolute;top:657px; left:325px">ou</p>
    <p style="position:absolute;top:657px; left:500px">DAC</p>
    <p style="position:absolute;top:660px; left:70px; border-bottom: 1px solid black; width:150px;height:20px; text-align:center">{{$bonDeCommande->um}}</p>
    <p style="height:20px;position:absolute;top:660px; left:550px;border-bottom:1px solid black;width:150px; text-align:center">{{$bonDeCommande->dac}}</p>


    <p style="position: absolute; border-bottom: 1px black solid;top:679px;width:700px;height:1px"></p>
    <p style="position:absolute;top:680px; left:50px">CHARGE</p>
    @if ($bonDeCommande->type == 'charge')
        <input style="position: absolute;top:680px;left:130px" type="checkbox" checked>
    @else
        <input style="position: absolute;top:680px;left:130px" type="checkbox">   
    @endif
    <p style="position:absolute;top:680px; left:300px">STOCK</p>
    @if ($bonDeCommande->type == 'stock')
        <input style="position: absolute;top:680px;left:380px" type="checkbox" checked>
    @else
        <input style="position: absolute;top:680px;left:380px" type="checkbox">
    @endif

    <style>
        .tableau-hafa td, .tableau-hafa th
        {
            border: 1px solid black;
            text-align: center;
            font-size: 10px;
        }
    </style>
    
    <table class="tableau-hafa" style="position: absolute;top:720px;">
        <style>
            .site
            {
                width: 100px;
                margin: 0;
                padding: 0;
                height: 13px;
                font-weight: bold;
            }
            .departement
            {
                width: 350px;
                text-align: left;
                margin-left: 10px;
                margin: 0;
                padding: 0;
                height: 13px;
                font-weight: bold;
            }
            .delegations
            {
                width: 250px;
                text-align: left;
                margin: 0;
                padding: 0;
                height: 13px;
                font-weight: bold;
            }
        </style>
        <thead>
            <input type="hidden" id="site" value="">
            <input type="hidden" id="departemement" value="">
            <input type="hidden" id="delegations" value="">
            <tr>
                <th class="site">SITE</th>
                <th style="text-align: center">DEPARTEMENT</th>
                <th class="delegations">DELEGATIONS ET AUTRES</th>
            </tr>
        </thead>
        <style>
            .nom-depart
            {
                width: 120px;
                text-align: center;
            }
            .nom-delegations
            {
                width: 150px;
                text-align: center;
            }
            .chiffre1, .chiffre4
            {
                margin-left: 150px;
                margin-top: -25px;	
                width: 80px;
                text-align: center;
            }
            .chiffre2
            {
                margin-left: 200px;
                margin-top: -30px;	
                width: 80px;
                text-align: center;
            }
            .chiffre3
            {
                margin-left: 280px;
                margin-top: -30px;	
                width: 80px;
                text-align: center;
            }
        </style>
        <tbody>
             <tr>
                <td>
                    <div class="site">
                        @if ($bonDeCommande->site == 'ABE')
                            <label><input type="radio" name="site" value="ABE" id="ABE" checked></label>
                        @else
                        <label><input type="radio" name="site" id="ABE" value="ABE"></label>
                        @endif
                        <label>ABE</label>
                    </div>
                </td>
                <td>
                    <div class="departement">
                        <div class="nom-depart"><label>SHIPPING</label></div>
                        <div class="chiffre1">
                             @if ($bonDeCommande->departement == '10A01')
                                <label><input type="radio" name="departement" id="10A01" value="10A01" checked></label>
                            @else
                            <label><input type="radio" name="departement" id="10A01" value="10A01" ></label>
                            @endif
                            <label>10A01</label>
                        </div>
                        <div class="chiffre2">
                            @if ($bonDeCommande->departement == '10B01')
                                <label><input type="radio" name="departement" id="10B01" value="10B01" checked></label>
                            @else
                            <label><input type="radio" name="departement" id="10B01" value="10B01" ></label>
                            @endif
                            <label>10B01</label>
                        </div>
                        <div class="chiffre3">
                            @if ($bonDeCommande->departement == '10T01')
                                <label><input type="radio" name="departement" id="10T01" value="10T01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="10T01" id="10T01" ></label>
                            @endif
                            <label>10T01</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="delegations">
                        <div class="nom-delegations"><label for="">&nbsp;BOLLORE STRUCTURE</label></div>
                        <div class="chiffre4">
                            @if ($bonDeCommande->delegations == 'MG1605A1')
                                <label><input type="radio" name="delegations" value="MG1605A1" id="MG1605A1" checked></label>
                            @else
                            <label><input type="radio" name="delegations" value="MG1605A1" id="MG1605A1" ></label>
                            @endif
                            <label>MG1605A1</label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        @if ($bonDeCommande->site == 'DIE')
                            <label><input type="radio" name="site" value="DIE" id="DIE" checked></label>
                        @else
                        <label><input type="radio" name="site" value="DIE" id="DIE"></label>
                        @endif
                        <label>DIE</label>
                    </div>
                </td>
                <td> 
                    <div class="departement">
                        <div class="nom-depart"><label>CTM</label></div>
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '20A01')
                                <label><input type="radio" name="departement" value="20A01" id="20A01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="20A01" id="20A01" ></label>
                            @endif
                            <label>20A01</label>
                        </div>
                        <div class="chiffre2">
                            @if ($bonDeCommande->departement == '20B01')
                                <label><input type="radio" name="departement" value="20B01" id="20B01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="20B01" id="20B01"></label>
                            @endif
                            <label>20B01</label>
                        </div>
                        <div class="chiffre3">
                            @if ($bonDeCommande->departement == '20T01')
                                <label><input type="radio" name="departement" value="20T01" id="20T01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="20T01" id="20T01"></label>
                            @endif
                            <label>20T01</label></div>
                        </div>
                    </div> 
                </td>
                <td>
                    <div class="delegations">
                        <div class="nom-delegations"> <label for="">&nbsp;AGL AFRICA</label></div>
                       <div class="chiffre4">
                        @if ($bonDeCommande->delegations == 'MG046200')
                            <label><input type="radio" name="delegations" value="MG046200" id="MG046200" checked></label>
                        @else
                            <label><input type="radio" name="delegations" value="MG046200" id="MG046200"></label>
                        @endif
                            <label>MG046200</label>
                       </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="site">
                    <div class="site">
                        @if ($bonDeCommande->site == 'FTU')
                            <label><input type="radio" name="site" value="FTU" id="FTU" checked></label>
                        @else
                        <label><input type="radio" name="site" value="FTU" id="FTU"></label>
                        @endif
                        <label>FTU</label>
                    </div>
                </td>
                <td>
                    <div class="departement">
                        <div class="nom-depart"><label>CTA</label></div> 
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '30A01')
                                <label><input type="radio" name="departement" value="30A01" id="30A01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="30A01" id="30A01" ></label>
                            @endif
                            <label>30A01</label>
                        </div>
                        <div class="chiffre2">
                            @if ($bonDeCommande->departement == '30B01')
                                <label><input type="radio" name="departement" value="30B01" id="30B01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="30B01" id="30B01"></label>
                            @endif
                            <label>30B01</label>
                        </div>
                        <div class="chiffre3">
                            @if ($bonDeCommande->departement == '30A02')
                                <label><input type="radio" name="departement" value="30A02" id="30A02" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="30A02" id="30A02"></label>
                            @endif
                            <label>30A02</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td class="site">
                    <div class="site">
                        @if ($bonDeCommande->site == 'IVT')
                            <label><input type="radio" name="site" value="IVT" id="IVT" checked></label>
                        @else
                        <label><input type="radio" name="site" value="IVT" id="IVT"></label>
                        @endif
                        <label>IVT</label>
                    </div>
                </td>
                <td>
                    <div class="departement">
                        <div class="nom-depart"><label>BASE LOGISTIQUE</label></div>
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '15100')
                                <label><input type="radio" name="departement" value="15100" id="15100" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="15100" id="15100" ></label>
                            @endif
                            <label>15100</label>
                        </div>
                        <div class="chiffre2">
                            @if ($bonDeCommande->departement == '20D01')
                                <label><input type="radio" name="departement" value="20D01" id="20D01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="20D01" id="20D01"></label>
                            @endif
                            <label>20D01</label>
                        </div>
                    </div> 
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        @if ($bonDeCommande->site == 'MJN')
                            <label><input type="radio" name="site" value="MJN" id="MJN" checked></label>
                        @else
                        <label><input type="radio" name="site" value="MJN" id="MJN"></label>
                        @endif
                        <label>MJN</label>
                    </div>
                </td>
                <td > 
                    <div class="departement">
                        <div class="nom-depart"><label>NSN</label></div>
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '40D00')
                                <label><input type="radio" name="departement" value="40D00" id="40D00" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="40D00" id="40D00" ></label>
                            @endif
                            <label>40D00</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        @if ($bonDeCommande->site == 'NSB')
                            <label><input type="radio" name="site" value="NSB" id="NSB" checked></label>
                        @else
                        <label><input type="radio" name="site" value="NSB" id="NSB"></label>
                        @endif
                        <label>NSB</label>
                    </div>
                </td>
                <td> 
                    <div class="departement">
                        <div class="nom-depart"><label>DG</label></div>
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '70B01')
                                <label><input type="radio" name="departement" value="70B01" id="70B01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="70B01" id="70B01" ></label>
                            @endif
                            <label>70B01</label>
                        </div>
                    </div>      
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        @if ($bonDeCommande->site == 'TJB')
                            <label><input type="radio" name="site" value="TJB" id="TJB" checked></label>
                        @else
                        <label><input type="radio" name="site" value="TJB" id="TJB"></label>
                        @endif
                        <label>TJB</label>
                    </div>
                </td>
                <td> 
                    <div class="departement">
                        <div class="nom-depart"><label>AGENCE</label></div>
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '70C01')
                                <label><input type="radio" name="departement" value="70C01" id="70C01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="70C01" id="70C01" ></label>
                            @endif
                            <label>70C01</label>
                        </div>
                        <div class="chiffre2">
                            @if ($bonDeCommande->departement == '70C03')
                                <label><input type="radio" name="departement" value="70C03" id="70C03" checked></label>
                            @else
                                <label><input type="radio" name="departement" value="70C03" id="70C03"></label>
                            @endif
                                <label>70C03</label>
                        </div>
                        <div class="chiffre3">
                            @if ($bonDeCommande->departement == '70C04')
                                <label><input type="radio" name="departement" value="70C04" id="70C04" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="70C04" id="70C04"></label>
                            @endif
                            <label>70C04</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        @if ($bonDeCommande->site == 'TMM')
                            <label><input type="radio" name="site" value="TMM" id="TMM" checked></label>
                        @else
                        <label><input type="radio" name="site" value="TMM" id="TMM"></label>
                        @endif
                        <label>TMM</label>
                    </div>
                </td>
                <td class="departement">
                    <div class="departement">
                        <div class="nom-depart"><label>DF</label></div>
                        <div class="chiffre1"> 
                            @if ($bonDeCommande->departement == '70E01')
                                <label><input type="radio" name="departement" value="70E01" id="70E01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="70E01" id="70E01" ></label>
                            @endif
                            <label>70E01</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations">AUTRES (a preciser)</div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        @if ($bonDeCommande->site == 'TUL')
                            <label><input type="radio" name="site" value="TUL" id="TUL" checked></label>
                        @else
                        <label><input type="radio" name="site" value="TUL" id="TUL"></label>
                        @endif
                        <label>TUL</label>
                    </div>
                </td>
                <td>
                    <div class="departement">
                        <div class="nom-depart"><label>INFORMATIQUE</label></div> 
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '70F01')
                                <label><input type="radio" name="departement" value="70F01" id="70F01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="70F01" id="70F01" ></label>
                            @endif
                            <label>70F01</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations">{{$bonDeCommande->autres}}</div></td>
            </tr>
            <tr>
                <td><div class="site"></div></td>
                <td class="departement">
                    <div class="departement">
                        <div class="nom-depart"><label>PERSONNEL</label></div>
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '70G01')
                                <label><input type="radio" name="departement" value="70G01" id="70G01" checked></label>
                            @else
                            <label><input type="radio" name="departement" value="70G01" id="70G01"></label>
                            @endif
                            <label>70G01</label>
                        </div>
                    </div>   
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td><div class="site"></div></td>
                <td class="departement">
                    <div class="departement">
                        <div class="nom-depart"><label>COMMERCIAL</label></div>
                        <div class="chiffre1">
                            @if ($bonDeCommande->departement == '20T00')
                                <label><input type="radio" name="departement" value="20T00" id="20T00" checked></label> 
                            @else
                            <label><input type="radio" name="departement" value="20T00" id="20T00" ></label>
                            @endif
                            <label>20T00</label>
                        </div>
                    </div> 
                </td>
                <td><div class="delegations"></div></td>
            </tr>
        </tbody>
    </table>
        <div style="font-size: 11px; position:absolute; top:930px;">
            Africa Global Logistics Madagascar <br>
            R.C.S. 2001 B 00022 du 30/05/2001 - Stat: 52297 31 1967 0 00002 du 23/06/2023 - N.I.F. : 0000020309 du 10/06/1970 <br>
            Siège : Rue du Capitaine Schoël - Ampasimazava - B.P 411 TOAMASINA 501 <br>
            Tél : +261 20 22 461 09/ +261 20 53 471 09 - aglgroup.com <br>
            E-mail: MG003-agl.madagascar@aglgroup.com <br>
            Agences : Antananarivo - Ivato - Antsirabe - Toamasina - Mahajanga - Antsiranana - Nosy Be - Toliary - Tolagnaro - Antalaha <br>
            <b>Africa Global Logistics / AGL.MDG.PUR.F.0122 Bordereau de commande / V05 du {{$bonDeCommande->date}}</b>
        </div>

        <style>
            .filigrane
            {
                position: absolute;
                font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; 
                top: 370px;
                left: 80px;
                font-size: 100px;
                color: rgba(0, 98, 255, 0.801);
                transform: rotate(-45deg);
                font-weight: bolder;
            }
        </style>
        <div class="filigrane">
            ORIGINAL
        </div>
</body>
</html>
