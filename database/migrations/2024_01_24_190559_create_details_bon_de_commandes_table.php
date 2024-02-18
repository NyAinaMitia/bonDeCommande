<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('details_bon_de_commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bon_de_commande_id')->constrained(); // Clé étrangère vers la table des bons de commande
            $table->foreignId('produit_id')->constrained(); // Clé étrangère vers la table des produits
            $table->integer('quantite');
            $table->integer('prix_ht');
            $table->float('tva')->nullable();
            $table->float('remise')->nullable();
            $table->float('total_ht')->nullable();
            $table->float('total_ttc')->nullable();
            $table->float('total_avec_remise')->nullable();
            // Ajoutez d'autres colonnes au besoin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_bon_de_commandes');
    }
};
