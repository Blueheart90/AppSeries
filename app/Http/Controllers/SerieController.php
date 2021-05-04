<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Serie;
use App\Models\TvList;
use App\Models\WatchingState;
use Illuminate\Http\Request;
use App\ViewModels\TvViewModel;
use App\ViewModels\TvShowViewModel;
use Illuminate\Support\Facades\Auth;
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
        // Querys
        $language = 'es-mx';
        // Series tentencia
        $trendingTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/trending/tv/week', ['language' => $language])
            ->json()['results'];

        // Series populares
        $popularTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/popular', ['language' => $language])
            ->json()['results'];

        // Series al aire
        $onAirTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/on_the_air', ['language' => $language])
            ->json()['results'];

        // Mejor calificadas
        $topRatedTv = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/top_rated', ['language' => $language])
            ->json()['results'];

        // Categorias Tv
        $genres = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/tv/list', ['language' => $language])
            ->json()['genres'];

        // $genremod =  collect($genres)->mapWithKeys(function ($genre){
        //     return [$genre['id'] => $genre['name']];
        // });

        $viewModel = new TvViewModel(
            $trendingTv,
            $popularTv,
            $onAirTv,
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
        // return view('series.home');
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
    public function show($serie)
    {
        // Querys
        $language = 'en-US';
        $imageLanguage = 'en,es,null';
        $appendResponse = 'credits,videos,images';

        // Series tentencia
        $tvShowDetails = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $serie, ['language' => $language,'append_to_response' => $appendResponse, 'include_image_language' => $imageLanguage])
            ->json();

        // ** Se comprueba si el user ya agregó la serie
        // $tvCheck = TvList::where([['api_id', $serie],['user_id', Auth::id()]])->exists();

        // ** Se obtiene el registro de la serie agregada por el User
        $tvCheck = TvList::where([['api_id', $serie],['user_id', Auth::id()]])->first();

        // ** Se obtiene los estados. ej viendo, en plan para ver , etc..
        // $stateWatchingList = WatchingState::all(['id','name']);

        // ** Se obtiene la escala de puntaje 1 a 10
        $scoreList = Score::all(['id','name']);

        $viewModel = new TvShowViewModel(
            $tvShowDetails,
            $tvCheck,
            // $stateWatchingList,
            $scoreList
        );


        return view('series.show', $viewModel);
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
    public function search(Request $request)
    {
        //
        // if ($request->ajax()) {
        // }
        $input = $request->input;
        // Buscar TvShow
        $busqueda = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/search/tv', ['language' => 'es-mx', 'query' => $input])
        ->json()['results'];

        return response($busqueda);
    }
}
