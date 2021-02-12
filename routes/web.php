<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SerieController;

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

Route::get('/', function () {
    return view('index');
});


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/users', function () {
        return view('users');
    })->name('users');

    // Rutas de Series
    Route::get('/series',[SerieController::class, 'index'])->name('series');
    Route::get('/series/{serie}/{slug?}', [SerieController::class, 'show'])->name('serie.show');
    Route::post('/series/buscar',[SerieController::class, 'search'])->name('search');
    // Route::get('/vacantes/create', 'VacanteController@create')->name('vacantes.create');
    // Route::post('/vacantes', 'VacanteController@store')->name('vacantes.store');
    // Route::delete('/vacantes/{vacante}', 'VacanteController@destroy')->name('vacantes.destroy');
    // Route::get('/vacantes/{vacante}/edit', 'VacanteController@edit')->name('vacantes.edit');
    // Route::put('/vacantes/{vacante}', 'VacanteController@update')->name('vacantes.update');

});
