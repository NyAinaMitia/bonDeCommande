<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsBonDeCommande extends Model
{
    use HasFactory;

    //un détails de bon de commande appartient à un bon de commande
    public function bonDeCommande()
    {
        return $this->belongsTo(BonDeCommande::class);
    }

    //un détails de bon de commande appartient à un produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    protected $fillable = ['bon_de_commande_id', 'produit_id', 'prix_ht', 'quantite', 'tva', 'remise','total_ht','total_ttc','total_avec_remise'];
}
