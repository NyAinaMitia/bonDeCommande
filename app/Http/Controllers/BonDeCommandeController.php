<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\BonDeCommande;
use App\Models\Produit;
use App\Models\User;
use App\Models\DetailsBonDeCommande;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\GeneratePdfJob;

class BonDeCommandeController extends Controller
{
    //
    public function users()
    {
        $users = User::all(); // Vous devez ajuster le modèle User en fonction de votre application
        return view('users.index', compact('users'));
    }
    public function fournisseurs()
    {
        $fournisseurs = Fournisseur::all(); // Vous devez ajuster le modèle Fournisseur en fonction de votre application
        return view('fournisseurs.index', compact('fournisseurs'));
    }
    public function produits()
    {
        $produits = Produit::all(); // Vous devez ajuster le modèle Produit en fonction de votre application
        return view('produits.index', compact('produits'));
    }
    public function create()
    {
        return view('bdc.create');
    }
    public function welcome()
    {
       // $bdcs = BonDeCommande::with('user')->get();
        $bdcs = BonDeCommande::with(['user' => function($query) {
            $query->select('id', 'service', 'agence');
        }])->get();
        return view('welcome', compact('bdcs')); 
    }
    public function index()
    {
        //$bdcs = BonDeCommande::all();
        $bdcs = BonDeCommande::with('user')->get();
        return view('welcome', compact('bdcs'));
    }
    public function show($bonDeCommandeId)
    {
        $bonDeCommande = BonDeCommande::with('detailsBonDeCommande.produit.fournisseur','user')->findOrFail($bonDeCommandeId);
        return view('bdc.index', ['bonDeCommande' => $bonDeCommande]);
    }
    public function autocompleteFournisseur(Request $request)
    {
        $query = $request->get('query');

        $results = Fournisseur::where('nom', 'LIKE', "%{$query}%")->get();

        return response()->json($results);
    }
    public function autocompleteDesignation(Request $request)
    {
        $query = $request->input('query');
        $fournisseurId = $request->input('fournisseur_id'); // Assurez-vous que le nom du champ est correct
        $resultats = Produit::where('fournisseur_id', $fournisseurId)
            ->where('designation', 'like', '%' . $query . '%')
            ->get();
        return response()->json($resultats);
    }
        //gérer la création d'un bon de commande
        public function store(Request $request)
        {
            //dd($request->all());
            //dd($request->input('pourcentage_remise'));

            $request->validate([
                'user_id' => 'required', // 'required|exists:users,id
                'fournisseur' => 'required', // 'required|exists:fournisseurs,id
                'fournisseur_id' => 'nullable|exists:fournisseurs,id',
                'devise' => 'required',
                'lieu_livraison' => 'required',
                'xm' => 'nullable',
                'xt' => 'nullable',
                '418100' => 'nullable',
                'um' => 'nullable',
                'dac' => 'nullable',
                'type' => 'required|in:charge,stock',
                'site' => 'required',
                'departement' => 'required',
                'delegations' => 'required',
                'autres' => 'nullable',
                'total_tva' => 'nullable',
                'total_remise' => 'nullable',
                'grand_total_ht' => 'nullable',
                'grand_total_ttc' => 'nullable',
                'grand_total_remise' => 'nullable',

                //pour le details de bon de commande
                'quantite.*' => 'required|numeric|min:1', // Validez les champs quantité dans le tableau
                'designation.*' => 'required',
                'prix_unitaire.*' => 'required|numeric|min:0',
                'tva.*' => 'nullable|numeric',
                'pourcentage_remise.*' => 'nullable|numeric|min:0|max:100',
            ]);
            
            //pour le numéro du bon de commande
            $anneeActuelle = date('Y');
            $numeroBonCommande = $anneeActuelle . sprintf('%06d', random_int(1, 999999));
            while (BonDeCommande::where('numero', $numeroBonCommande)->exists()) {
                $numeroBonCommande = $anneeActuelle . sprintf('%06d', random_int(1, 999999));
            }
            $request->merge(['numero' => $numeroBonCommande]);

            //pour la date actuelle sur le bon de commande
            $formattedDate = Carbon::now()->format('d/m/Y');
            $standardDate = Carbon::createFromFormat('d/m/Y', $formattedDate)->format('Y-m-d');
            $request->merge(['date' => $standardDate]);


            try {
                $bonDeCommande = BonDeCommande::create($request->all());
                // Pour chaque ligne du tableau de détails
                foreach ($request->input('quantite') as $index => $quantite) {
                    // Récupérer ou créer le produit correspondant au fournisseur
                    $produit = Produit::firstOrCreate([
                        'fournisseur_id' => $request->input('fournisseur_id'),
                        'designation' => $request->input('designation')[$index],
                    ]);
                            
                    if ($produit) {
                        // Créer une entrée dans la table details_bon_de_commande
                        $details = [
                            'bon_de_commande_id' => $bonDeCommande->id,
                            'produit_id' => $produit->id,
                            'quantite' => $quantite,
                            'designation' => $request->input('designation')[$index],
                            'prix_ht' => $request->input('prix_unitaire')[$index],
                            'tva' => $request->input('tva')[$index],
                            'remise' => $request->input('pourcentage_remise')[$index],
                            'total_ht' => $request->input('total_ht')[$index],
                            'total_ttc' => $request->input('total_ttc')[$index],
                            'total_avec_remise' => $request->input('total_avec_remise')[$index],
                        ];
                
                    DetailsBonDeCommande::create($details);

                    } else {
                         throw new \Exception("Impossible de trouver ou de créer le produit pour le fournisseur.");
                    }
                }
                    $pdfFileName = $this->generatePdf($bonDeCommande->id);
                    session()->flash('success', 'Bon de commande créé avec succès');
                    return response()->download(public_path('pdf/' . $pdfFileName));
                    

            } catch (\Exception $e) {
                dd($e->getMessage(), $e->getTrace());
            }
        }

        public function generatePdf($bonDeCommandeId)
        {
            try {
                $bonDeCommande = BonDeCommande::findOrFail($bonDeCommandeId);
                
                $pdf = PDF::loadView('bdc.pdf', ['bonDeCommande' => $bonDeCommande]);
                
                $pdfFileName = 'BonDeCommande' . $bonDeCommandeId . '.pdf';
                
                $pdf->save(public_path('pdf/' . $pdfFileName));
                
                return $pdfFileName;
            } catch (\Exception $e) {
                dd("Error in generatePdf: " . $e->getMessage());
            }
        }

}
