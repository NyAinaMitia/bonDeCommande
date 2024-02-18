<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BonDeCommandeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\GeneratePdfController;
use App\Http\Controllers\AuthController;

//définir les routes nécesssaires pour les opérations CRUD sur une ressource
Route::resource('users', UserController::class);

Route::resource('fournisseurs', FournisseurController::class);

Route::resource('produits', ProduitController::class);

Route::resource('bdc', BonDeCommandeController::class);

/*
Voici une correspondance entre les routes générées par resource et les actions du contrôleur :
GET /users : Affiche la liste des utilisateurs (action index dans UserController).
GET /users/create : Affiche le formulaire de création d'utilisateur (action create dans UserController).
POST /users : Traite la création d'un nouvel utilisateur (action store dans UserController).
GET /users/{user} : Affiche les détails d'un utilisateur spécifique (action show dans UserController).
GET /users/{user}/edit : Affiche le formulaire de modification d'un utilisateur (action edit dans UserController).
PUT/PATCH /users/{user} : Traite la mise à jour d'un utilisateur spécifique (action update dans UserController).
DELETE /users/{user} : Supprime un utilisateur spécifique (action destroy dans UserController).
*/

/*Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', [BonDeCommandeController::class, 'welcome'])->name('bdc.welcome');
Route::get('/users', [BonDeCommandeController::class, 'users'])->name('users.index');
Route::get('/fournisseurs', [BonDeCommandeController::class, 'fournisseurs'])->name('fournisseurs.index');
Route::get('/produits', [BonDeCommandeController::class, 'produits'])->name('produits.index');

Route::get('/bdc/create', [BonDeCommandeController::class, 'create'])->name('bdc.create');

Route::get('/bdc/create/autompleteFournisseur', [BonDeCommandeController::class, 'autocompleteFournisseur'])->name('bdc.autocompleteFournisseur');

Route::get('/bdc/create/autompleteDesignation', [BonDeCommandeController::class, 'autocompleteDesignation'])->name('bdc.autocompleteDesignation');

Route::get('/bdc/create/generatePdf', [BonDeCommandeController::class, 'generatePdf'])->name('bdc.generatePdf');

Route::get('/generatePDF', [GeneratePdfController::class, 'generatePdf'])->name('genenatePdf');
*/

// Route pour afficher le formulaire de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [BonDeCommandeController::class, 'welcome'])->middleware('auth')->name('bdc.welcome');

Route::middleware(['auth'])->group(function () {
    // Définissez vos autres routes ici
    Route::get('/users', [BonDeCommandeController::class, 'users'])->name('users.index');
    Route::get('/fournisseurs', [BonDeCommandeController::class, 'fournisseurs'])->name('fournisseurs.index');
    Route::get('/produits', [BonDeCommandeController::class, 'produits'])->name('produits.index');
    Route::get('/bdc/create', [BonDeCommandeController::class, 'create'])->name('bdc.create');
    Route::get('/bdc/create/autompleteFournisseur', [BonDeCommandeController::class, 'autocompleteFournisseur'])->name('bdc.autocompleteFournisseur');
    Route::get('/bdc/create/autompleteDesignation', [BonDeCommandeController::class, 'autocompleteDesignation'])->name('bdc.autocompleteDesignation');
    Route::get('/bdc/create/generatePdf', [BonDeCommandeController::class, 'generatePdf'])->name('bdc.generatePdf');
    Route::get('/generatePDF', [GeneratePdfController::class, 'generatePdf'])->name('genenatePdf');
});