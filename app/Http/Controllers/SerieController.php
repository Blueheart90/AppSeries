<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
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

        // Peliculas populares
        // $popularMovie = Http::withToken(config('services.tmdb.token'))
        //     ->get('https://api.themoviedb.org/3/trending/movie/week', ['language' => 'es-mx'])
        //     ->json()['results'];


        // $genre =  collect($genreArray)->mapWithKeys(function ($genre){
        //     return [$genre['id'] => $genre['name']];
        // });

        // Series populares
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/trending/tv/week', ['language' => 'es-mx'])
            ->json()['results'];

        // Mejor calificadas
        $topRatedTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated', ['language' => 'es-mx'])
            ->json()['results'];

        // Categorias Tv
        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list', ['language' => 'es-mx'])
            ->json()['genres'];

        // $genremod =  collect($genres)->mapWithKeys(function ($genre){
        //     return [$genre['id'] => $genre['name']];
        // });

        $viewModel = new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        // collect($popularTv)->map(function ($tvshow){
        //     $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value){
        //         return [$value => $this->genres()->get($value)];
        //     });
        // });
        //  return $genresFormatted;

        // $prueba = collect($popularTv)->first();
        // $genresFormatted = collect($prueba['genre_ids'])->mapWithKeys(function ($value){
        //     return ['id' => $value];
        // })->implode(',');

        return view('series.home', $viewModel);
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
