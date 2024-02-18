<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    //un fournisseur peut avoir plusieurs produits
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
    protected $fillable = [
        'nom',
        'reference_iris',
    ];
}
