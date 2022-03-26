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

/*
Route::get('/', function () {
    return view('welcome');
});*/

use App\Http\Controllers\HomeController;
//Route::get('/', [HomeController::class, 'index']);

Route::get('/', 'App\Http\Controllers\MenuController@index');

Route::get('/home', 'App\Http\Controllers\MenuController@index');

Route::get('/series', 'App\Http\Controllers\SeriesController@index');

Route::get('/contact', 'App\Http\Controllers\ContactController@index');


Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

Route::get('/series/{serie}', [App\Http\Controllers\SeriesController::class, 'number'])->name('series.show');


Auth::routes();

Route::get('/logout', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/series/c/{serie}',[App\Http\Controllers\SeriesController::class, 'createComment'])->name('c_series.show');

Route::post('/c_store','App\Http\Controllers\CommentsController@store');

Route::post('/c_remove','App\Http\Controllers\CommentsController@remove');

Route::post('/c_update','App\Http\Controllers\CommentsController@update');

Route::post('/s_store','App\Http\Controllers\SeriesController@store');

Route::post('/s_remove','App\Http\Controllers\SeriesController@remove');

Route::post('/s_update','App\Http\Controllers\SeriesController@update');

Route::get('/update/series/{serie}','App\Http\Controllers\SeriesController@updateSerie')->name('series.show');

Route::get('/create/serie', 'App\Http\Controllers\SeriesController@createSerie');

Route::post('/contact_store', 'App\Http\Controllers\ContactController@store');


//Ajouter, retirer les droits d'administration à un profil
Route::post('/new_admin','App\Http\Controllers\ProfilesController@newAdmin');

Route::post('/remove_admin','App\Http\Controllers\ProfilesController@removeAdmin');

Route::post('/rate_store','App\Http\Controllers\RatesController@store');