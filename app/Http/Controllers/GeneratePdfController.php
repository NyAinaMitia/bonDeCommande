<?php

namespace App\Http\Controllers;
use App\Models\BonDeCommande;
use App\Models\DetailsBonDeCommande;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class GeneratePdfController extends Controller
{
    //
    function generatePdf()
    {
        $bonDeCommande = BonDeCommande::with('details')->first();
        $pdf = Pdf::loadView('bdc.pdf', ['bonDeCommande' => $bonDeCommande ]);
        return $pdf->download('BonDeCommande.pdf');
    }
}
