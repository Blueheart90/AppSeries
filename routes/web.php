<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvListController;
use App\Models\TvList;

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

    // Rutas TvList
    Route::post('/tvlist',[TvListController::class, 'store'])->name('tvlist.store');
    Route::get('/tvlist/{id}',[TvListController::class, 'checkUser'])->name('tvlist.checkuser');
    Route::put('/tvlist/{tvlist}',[TvListController::class, 'update'])->name('tvlist.update');

    // Rutas de peliculas
    Route::get('/peliculas',[MovieController::class, 'index'])->name('peliculas');
    // Route::get('/peliculas/{serie}/{slug?}', [MovieController::class, 'show'])->name('serie.show');
    // Route::post('/peliculas/buscar',[MovieController::class, 'search'])->name('search');


});
