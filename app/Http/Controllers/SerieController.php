<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Categorias Peliculas
        // $genreArray = Http::withToken(config('services.tmdb.token'))
        //     ->get('https://api.themoviedb.org/3/genre/movie/list', ['language' => 'es-mx'])
        //     ->json()['genres'];
        // $genre =  collect($genreArray)->mapWithKeys(function ($genre){
        //     return [$genre['id'] => $genre['name']];
        // });

        // Categorias Tv
        // $genreArray = Http::withToken(config('services.tmdb.token'))
        //     ->get('https://api.themoviedb.org/3/genre/tv/list', ['language' => 'es-mx'])
        //     ->json()['genres'];
        // $genre =  collect($genreArray)->mapWithKeys(function ($genre){
        //     return [$genre['id'] => $genre['name']];
        // });

        // Series populares
        $trendingTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/trending/tv/week', ['language' => 'es-mx'])
            ->json()['results'];

        // Peliculas populares
        $trendingMovie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/trending/movie/week', ['language' => 'es-mx'])
            ->json()['results'];



        dd($trendingMovie);
        // return phpinfo();


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serie $serie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        //
    }
}
