<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin
Route::get('/',\App\Http\Controllers\AdminController::class . '@index');
Route::post('/log_admin',\App\Http\Controllers\AdminController::class . '@login');


//front
Route::get('/front',\App\Http\Controllers\UtilisateurController::class.'@index');
Route::post('/frontlogin',\App\Http\Controllers\UtilisateurController::class.'@login');


//crud patient
Route::get('/formpatient',\App\Http\Controllers\PatientController::class . '@form');
Route::get('/listePatient',\App\Http\Controllers\PatientController::class . '@listePatient');
Route::get('/paginationpatient/{numero}',\App\Http\Controllers\PatientController::class . '@pagination');
Route::get('/versmodifpatient/{id}',\App\Http\Controllers\PatientController::class . '@versmodifier');
Route::post('/modifierpatient',\App\Http\Controllers\PatientController::class . '@modifier');
Route::post('/ajouterpatient',\App\Http\Controllers\PatientController::class . '@ajouter');
Route::get('/supprimerpatient/{id}',\App\Http\Controllers\PatientController::class . '@supprimer');
Route::post('/recherchepatient',\App\Http\Controllers\PatientController::class . '@recherche');

//crud typedepense
Route::get('/formtypedepense',\App\Http\Controllers\TypedepenseController::class . '@form');
Route::get('/listeTypedepense',\App\Http\Controllers\TypedepenseController::class . '@listeTypedepense');
Route::get('/paginationtypedepense/{numero}',\App\Http\Controllers\TypedepenseController::class . '@pagination');
Route::get('/versmodiftypedepense/{id}',\App\Http\Controllers\TypedepenseController::class . '@versmodifier');
Route::post('/modifiertypedepense',\App\Http\Controllers\TypedepenseController::class . '@modifier');
Route::post('/ajoutertypedepense',\App\Http\Controllers\TypedepenseController::class . '@ajouter');
Route::get('/supprimertypedepense/{id}',\App\Http\Controllers\TypedepenseController::class . '@supprimer');
Route::post('/recherchetypedepense',\App\Http\Controllers\TypedepenseController::class . '@recherche');

//crud typerecette
Route::get('/formtyperecette',\App\Http\Controllers\TyperecetteController::class . '@form');
Route::get('/listeTyperecette',\App\Http\Controllers\TyperecetteController::class . '@listeTyperecette');
Route::get('/paginationtyperecette/{numero}',\App\Http\Controllers\TyperecetteController::class . '@pagination');
Route::get('/versmodiftyperecette/{id}',\App\Http\Controllers\TyperecetteController::class . '@versmodifier');
Route::post('/modifiertyperecette',\App\Http\Controllers\TyperecetteController::class . '@modifier');
Route::post('/ajoutertyperecette',\App\Http\Controllers\TyperecetteController::class . '@ajouter');
Route::get('/supprimertyperecette/{id}',\App\Http\Controllers\TyperecetteController::class . '@supprimer');
Route::post('/recherchetyperecette',\App\Http\Controllers\TyperecetteController::class . '@recherche');

//crud depense
Route::get('/formdepense',\App\Http\Controllers\DepenseController::class . '@form');
Route::get('/listeDepense',\App\Http\Controllers\DepenseController::class . '@listeDepense');
Route::get('/paginationdepense/{numero}',\App\Http\Controllers\DepenseController::class . '@pagination');
Route::get('/versmodifdepense/{id}',\App\Http\Controllers\DepenseController::class . '@versmodifier');
Route::post('/modifierdepense',\App\Http\Controllers\DepenseController::class . '@modifier');
Route::post('/ajouterdepense1',\App\Http\Controllers\DepenseController::class . '@create');
Route::get('/supprimerdepense/{id}',\App\Http\Controllers\DepenseController::class . '@supprimer');
Route::post('/recherchedepense',\App\Http\Controllers\DepenseController::class . '@recherche');

//crud facture_recette
Route::get('/formfacturerecette',\App\Http\Controllers\FacturerecetteController::class . '@form');
Route::get('/listeFacturerecette',\App\Http\Controllers\FacturerecetteController::class . '@listeFacturerecette');
Route::get('/paginationfacturerecette/{numero}',\App\Http\Controllers\FacturerecetteController::class . '@pagination');
Route::get('/versmodiffacturerecette/{id}',\App\Http\Controllers\FacturerecetteController::class . '@versmodifier');
Route::post('/modifierfacturerecette',\App\Http\Controllers\FacturerecetteController::class . '@modifier');
Route::post('/ajouterfacturerecette',\App\Http\Controllers\FacturerecetteController::class . '@ajouter');
Route::get('/supprimerfacturerecette/{id}',\App\Http\Controllers\FacturerecetteController::class . '@supprimer');
Route::post('/recherchefacturerecette',\App\Http\Controllers\FacturerecetteController::class . '@recherche');



//crud recette
Route::post('/ajouterrecette',\App\Http\Controllers\RecetteController::class . '@ajouter');
Route::get('/formrecette',\App\Http\Controllers\RecetteController::class . '@form');
Route::get('/listeRecette',\App\Http\Controllers\RecetteController::class . '@listeRecette');
Route::get('/paginationrecette/{numero}',\App\Http\Controllers\RecetteController::class . '@pagination');
Route::get('/versmodifrecette/{id}',\App\Http\Controllers\RecetteController::class . '@versmodifier');
Route::post('/modifierrecette',\App\Http\Controllers\RecetteController::class . '@modifier');
Route::get('/supprimerrecette/{id}',\App\Http\Controllers\RecetteController::class . '@supprimer');
Route::post('/rechercherecette',\App\Http\Controllers\RecetteController::class . '@recherche');


//Tableau de bord
//statistique
Route::get('/listeStatistique',\App\Http\Controllers\TableauController::class . '@tableau_de_bord');
Route::post('/filtre',\App\Http\Controllers\TableauController::class . '@filtre');

//pdf
Route::get('/pdf/{id}', \App\Http\Controllers\PDFController::class . '@pdf');

//csv
use App\Http\Controllers\DepenseController;
Route::post('/import-csv', [DepenseController::class, 'importCSV'])->name('import.csv');



