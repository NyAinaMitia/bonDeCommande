<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            margin-left: 460px;
            position: absolute;
            top: 100px;
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
            <input type="text" class="resultat" value="" readonly>
            <input type="text" class="resultat" value="" readonly>
            <input type="text" class="resultat" value="" readonly>
        </div>
    </div>
    <div class="fournisseur">
        <label for="">Fournisseur</label><input type="text" class="resultat" value="" readonly></p>
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
                    <td id="quantite"></td>
                    <td id="designation"></td>
                    <td id="pu"></td>
                    <td id="total"></td>
                </tr>
            @endfor
            <tr>
                <td></td>
                <th>TOTAL (ou à reporter)</th>
                <td></td>
                <td> Ar HT </td>
            </tr>
            <tr>
                <td></td>
                <th>TVA</th>
                <td> Ar</td>
                <td> Ar TTC </td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p><strong>Signature</strong></p>
    </div>

    <p class="lieu_livraison"><strong>Lieu de livraison</strong></p>
    <div style="font-size: 11px;">
        <p style=" position:absolute;top: 550px">Tanjombato</p>
        <p style=" position:absolute;top: 550px;left:200px">Toamasina Log</p>
        <p style=" position:absolute;top: 550px;left:400px">Mahajanga</p>
        <p style=" position:absolute;top: 550px;left:600px">Antsiranana</p>
        <p style=" position:absolute;top: 565px">Ivato</p>
        <p style=" position:absolute;top: 565px;left:200px">Tamatave</p>
        <p style=" position:absolute;top:565px;left:400px">Tolagnaro</p>
        <p style=" position:absolute;top: 565px;left:600px">Nosy Be</p>
        <p style=" position:absolute;top: 580px">Antanimena</p>
        <p style=" position:absolute;top: 580px;left:200px">Antsirabe</p>
        <p style=" position:absolute;top: 580px;left:400px">Toliara</p>
    </div>


    <p class="message dashed_border" style="position: absolute; top:610px">Débours : les prises en charges directes par
        le client ne donnent pas lieu à une commande sous notre en-tête &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p style="position:absolute;top:625px; left:50px">XM</p>
    <p style="position:absolute;top:625px; left:250px">XT</p>
    <p style="position:absolute;top:625px; left:500px">418100</p>
    <p style="position:absolute;top:630px; left:70px; border-bottom: 1px solid black; width:150px;height:20px"></p>
    <p style=" height:20px;position:absolute;top:630px; left:270px;border-bottom: 1px solid black;width:150px"></p>
    <p style="height:20px;position:absolute;top:630px; left:550px;border-bottom:1px solid black;width:150px"></p>


    <p style="position: absolute; border-bottom: 1px black solid;top:654px;width:700px;height:1px"></p>

    <p style="position:absolute;top:657px; left:50px">UM</p>
    <p style="position:absolute;top:657px; left:325px">ou</p>
    <p style="position:absolute;top:657px; left:500px">DAC</p>
    <p style="position:absolute;top:660px; left:70px; border-bottom: 1px solid black; width:150px;height:20px"></p>
    <p style="height:20px;position:absolute;top:660px; left:550px;border-bottom:1px solid black;width:150px"></p>


    <p style="position: absolute; border-bottom: 1px black solid;top:679px;width:700px;height:1px"></p>
    <p style="position:absolute;top:680px; left:50px">CHARGE</p><input style="position: absolute;top:680px;left:130px" type="checkbox">
    <p style="position:absolute;top:680px; left:300px">STOCK</p><input style="position: absolute;top:680px;left:380px" type="checkbox">
    <p style="position: absolute; border-bottom: 1px black solid;top:710px;width:700px;height:1px"></p>
    
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
                        <label><input type="radio" name="site" id="ABE" value="ABE"></label>
                        <label>ABE</label>
                    </div>
                </td>
                <td>
                    <div class="departement">
                        <div class="nom-depart"><label>SHIPPING</label></div>
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" id="10A01" value="10A01" ></label>
                            <label>10A01</label>
                        </div>
                        <div class="chiffre2">
                            <label><input type="radio" name="departement" id="10B01" value="10B01" ></label>
                            <label>10B01</label>
                        </div>
                        <div class="chiffre3">
                            <label><input type="radio" name="departement" value="10T01" id="10T01" ></label>
                            <label>10T01</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="delegations">
                        <div class="nom-delegations"><label for="">&nbsp;BOLLORE STRUCTURE</label></div>
                        <div class="chiffre4">
                            <label><input type="radio" name="delegations" value="MG1605A1" id="MG1605A1" ></label>
                            <label>MG1605A1</label>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        <label><input type="radio" name="site" value="DIE" id="DIE"></label>
                        <label>DIE</label>
                    </div>
                </td>
                <td> 
                    <div class="departement">
                        <div class="nom-depart"><label>CTM</label></div>
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" value="20A01" id="20A01" ></label>
                            <label>20A01</label>
                        </div>
                        <div class="chiffre2">
                            <label><input type="radio" name="departement" value="20B01" id="20B01"></label>
                            <label>20B01</label>
                        </div>
                        <div class="chiffre3">
                            <label><input type="radio" name="departement" value="20T01" id="20T01"></label>
                            <label>20T01</label></div>
                        </div>
                    </div> 
                </td>
                <td>
                    <div class="delegations">
                        <div class="nom-delegations"> <label for="">&nbsp;AGL AFRICA</label></div>
                       <div class="chiffre4">
                            <label><input type="radio" name="delegations" value="MG046200" id="MG046200"></label>
                            <label>MG046200</label>
                       </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="site">
                    <div class="site">
                        <label><input type="radio" name="site" value="FTU" id="FTU"></label>
                        <label>FTU</label>
                    </div>
                </td>
                <td>
                    <div class="departement">
                        <div class="nom-depart"><label>CTA</label></div> 
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" value="30A01" id="30A01" ></label>
                            <label>30A01</label>
                        </div>
                        <div class="chiffre2">
                            <label><input type="radio" name="departement" value="30B01" id="30B01"></label>
                            <label>30B01</label>
                        </div>
                        <div class="chiffre3">
                            <label><input type="radio" name="departement" value="30A02" id="30A02"></label>
                            <label>30A02</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td class="site">
                    <div class="site">
                        <label><input type="radio" name="site" value="IVT" id="IVT"></label>
                        <label>IVT</label>
                    </div>
                </td>
                <td>
                    <div class="departement">
                        <div class="nom-depart"><label>BASE LOGISTIQUE</label></div>
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" value="15100" id="15100" ></label>
                            <label>15100</label>
                        </div>
                        <div class="chiffre2">
                            <label><input type="radio" name="departement" value="20D01" id="20D01"></label>
                            <label>20D01</label>
                        </div>
                    </div> 
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        <label><input type="radio" name="site" value="MJN" id="MJN"></label>
                        <label>MJN</label>
                    </div>
                </td>
                <td > 
                    <div class="departement">
                        <div class="nom-depart"><label>NSN</label></div>
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" value="40D00" id="40D00" ></label>
                            <label>40D00</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        <label><input type="radio" name="site" value="NOS" id="NOS"></label>
                        <label>NOS</label>
                    </div>
                </td>
                <td> 
                    <div class="departement">
                        <div class="nom-depart"><label>DG</label></div>
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" value="70B01" id="70B01" ></label>
                            <label>70B01</label>
                        </div>
                    </div>      
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        <label><input type="radio" name="site" value="TJB" id="TJB"></label>
                        <label>TJB</label>
                    </div>
                </td>
                <td> 
                    <div class="departement">
                        <div class="nom-depart"><label>AGENCE</label></div>
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" value="70C01" id="70C01" ></label>
                            <label>70C01</label>
                        </div>
                        <div class="chiffre2">
                            <label><input type="radio" name="departement" value="70C03" id="70C03"></label>
                            <label>70C03</label>
                        </div>
                        <div class="chiffre3">
                            <label><input type="radio" name="departement" value="70C04" id="70C04"></label>
                            <label>70C04</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        <label><input type="radio" name="site" value="TMM" id="TMM"></label>
                        <label>TMM</label>
                    </div>
                </td>
                <td class="departement">
                    <div class="departement">
                        <div class="nom-depart"><label>DF</label></div>
                        <div class="chiffre1"> 
                            <label><input type="radio" name="departement" value="70E01" id="70E01" ></label>
                            <label>70E01</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations">AUTRES (a preciser)</div></td>
            </tr>
            <tr>
                <td>
                    <div class="site">
                        <label><input type="radio" name="site" value="TUL" id="TUL"></label>
                        <label>TUL</label>
                    </div>
                </td>
                <td>
                    <div class="departement">
                        <div class="nom-depart"><label>INFORMATIQUE</label></div> 
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" value="70F01" id="70F01" ></label>
                            <label>70F01</label>
                        </div>
                    </div>
                </td>
                <td><div class="delegations"></div></td>
            </tr>
            <tr>
                <td><div class="site"></div></td>
                <td class="departement">
                    <div class="departement">
                        <div class="nom-depart"><label>PERSONNEL</label></div>
                        <div class="chiffre1">
                            <label><input type="radio" name="departement" value="70G01" id="70G01"></label>
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
                            <label><input type="radio" name="departement" value="20T00" id="20T00" ></label>
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
            <b>Africa Global Logistics / AGL.MDG.PUR.F.0122 Bordereau de commande / V05 du </b>
        </div>
</body>
</html>
