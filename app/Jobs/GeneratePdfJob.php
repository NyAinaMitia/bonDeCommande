<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\BonDeCommande;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratePdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $bonDeCommandeId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($bonDeCommandeId)
    {
        //
        $this->bonDeCommandeId = $bonDeCommandeId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $bonDeCommande = BonDeCommande::findOrFail($this->bonDeCommandeId);
            $detailsBonDeCommande = $bonDeCommande->detailsBonDeCommande;
            $pdf = PDF::loadView('bdc.pdf', ['bonDeCommande' => $bonDeCommande, 'detailsBonDeCommande' => $detailsBonDeCommande]);
            return $pdf->download('BonDeCommande__'.$this->bonDeCommandeId.'.pdf');
        } catch (\Exception $e) {
            dd("Error in generatePdf: " . $e->getMessage());
        }
    }

}
