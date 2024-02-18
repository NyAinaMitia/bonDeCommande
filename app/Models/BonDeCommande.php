<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonDeCommande extends Model
{
    use HasFactory;

    //le bon de commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //un bon de commande peut avoir plusieurs détails de bon de commande
    public function detailsBonDeCommande()
    {
        return $this->hasMany(DetailsBonDeCommande::class, 'bon_de_commande_id');
    }

    public function produit()
    {
        return $this->belongsToMany(Produit::class, 'fournisseur_id');
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }

    protected $fillable = [
        'user_id',
        'numero', 
        'date', 
        'fournisseur_id', 
        'devise', 
        'lieu_livraison',
        'xm', 'xt', '418100', 'um', 'dac', 'type', 'site',
        'departement', 'delegations', 'autres',
        'total_tva','total_remise','grand_total_ht','grand_total_ttc','grand_total_remise'
    ];
}
