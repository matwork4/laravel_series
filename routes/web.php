<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
| Ruffieux Mathis
|--------------------------------------------------------------------------
*/


//Routes du menu
Route::get('/', 'App\Http\Controllers\MenuController@index');
Route::get('/home', 'App\Http\Controllers\MenuController@index');

//Route de la page des séries
Route::get('/series', 'App\Http\Controllers\SeriesController@index');

//Route de la page contacts
Route::get('/contact', 'App\Http\Controllers\ContactController@index');

//Route du profil d'un user
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

//Route d'une série
Route::get('/series/{serie}', [App\Http\Controllers\SeriesController::class, 'number'])->name('series.show');

//Routes pour l'authentification
Auth::routes();

Route::get('/logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//CRUD commentaires
Route::post('/c_store','App\Http\Controllers\CommentsController@store');
Route::post('/c_remove','App\Http\Controllers\CommentsController@remove');
Route::post('/c_update','App\Http\Controllers\CommentsController@update');

//CRUD séries
Route::post('/s_store','App\Http\Controllers\SeriesController@store');
Route::post('/s_remove','App\Http\Controllers\SeriesController@remove');
Route::post('/s_update','App\Http\Controllers\SeriesController@update');

Route::get('/update/series/{serie}','App\Http\Controllers\SeriesController@updateSerie')->name('series.show');

Route::get('/create/serie', 'App\Http\Controllers\SeriesController@createSerie');

//Formulaire de contact
Route::post('/contact_store', 'App\Http\Controllers\ContactController@store');


//Ajouter, retirer les droits d'administration à un profil
Route::post('/new_admin','App\Http\Controllers\ProfilesController@newAdmin');
Route::post('/remove_admin','App\Http\Controllers\ProfilesController@removeAdmin');

//Noter une série
Route::post('/rate_store','App\Http\Controllers\RatesController@store');

//Barre de recherche
Route::post('/series_search', 'App\Http\Controllers\SeriesController@searchByTags');