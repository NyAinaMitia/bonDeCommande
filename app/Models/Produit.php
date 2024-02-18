<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fournisseur_id',
        'designation',
    ];

    //un produit appartient à un fournisseur
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    //un produit peut avoir plusieurs détails de bon de commande
    public function detailsBonDeCommande()
    {
        return $this->hasMany(DetailsBonDeCommande::class);
    }
}
