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
        Schema::create('bon_de_commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Clé étrangère vers la table des utilisateurs
            $table->foreignId('fournisseur_id')->constrained(); // Clé étrangère vers la table des fournisseurs
            $table->string('numero');
            $table->date('date');
            $table->string('devise'); // Ajoutez la colonne pour la devise
            $table->string('lieu_livraison'); // Ajoutez la colonne pour le lieu de livraison
            // infos complémentaires
            $table->string('xm')->nullable();
            $table->string('xt')->nullable();
            $table->string('418100')->nullable();
            $table->string('um')->nullable();
            $table->string('dac')->nullable();
            $table->string('type');
            $table->string('site');
            $table->string('departement');
            $table->string('delegations');
            $table->string('autres')->nullable();
            $table->float('total_tva')->nullable();
            $table->float('total_remise')->nullable();
            $table->float('grand_total_ht')->nullable();
            $table->float('grand_total_ttc')->nullable();
            $table->float('grand_total_remise')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_de_commandes');
    }
};
