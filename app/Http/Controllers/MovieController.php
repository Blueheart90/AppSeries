<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Score;
use App\Models\MovieList;
use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\ViewModels\MovieShowViewModel;
use App\Exceptions\ApiResourceNotFoundException;

class MovieController extends Controller
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
         // Peliculas tentencia
         $trendingMovie = Http::withToken(config('services.tmdb.token'))
             ->get('https://api.themoviedb.org/3/trending/movie/week', ['language' => $language])
             ->json()['results'];

         // Peliculas populares
         $popularMovie = Http::withToken(config('services.tmdb.token'))
             ->get('https://api.themoviedb.org/3/movie/popular', ['language' => $language])
             ->json()['results'];

         // Peliculas al aire
         $nowPlayingMovie = Http::withToken(config('services.tmdb.token'))
             ->get('https://api.themoviedb.org/3/movie/now_playing', ['language' => $language])
             ->json()['results'];

         // Mejor calificadas
         $topRatedMovie = Http::withToken(config('services.tmdb.token'))
             ->get('https://api.themoviedb.org/3/movie/top_rated', ['language' => $language])
             ->json()['results'];

         // Categorias Peliculas
         $genres = Http::withToken(config('services.tmdb.token'))
             ->get('https://api.themoviedb.org/3/genre/movie/list', ['language' => $language])
             ->json()['genres'];



         $viewModel = new MovieViewModel(
             $trendingMovie,
             $popularMovie,
             $nowPlayingMovie,
             $topRatedMovie,
             $genres,
         );

         return view('movies.home', $viewModel);
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
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show($movie)
    {
        // Querys
        $language = 'es-mx';
        $imageLanguage = 'en,es,null';
        $appendResponse = 'credits,videos,images';



        try {
            // Detalles de Pelicula
            $movieShowDetails = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/movie/' . $movie, ['language' => $language,'append_to_response' => $appendResponse, 'include_image_language' => $imageLanguage])
                ->json();

            if (array_key_exists('success', $movieShowDetails)) {

                throw new ApiResourceNotFoundException('El recurso no esta disponible en la api');
            }
        } catch (ApiResourceNotFoundException $e) {
            session()->flash('message', $e->getMessage());
            return view('users.notfound');
        }

        // ** Se comprueba si el user ya agregó la movie
        // $movieCheck = movieList::where([['api_id', $movie],['user_id', Auth::id()]])->exists();

        // ** Se obtiene el registro de la movie agregada por el User
        $movieCheck = MovieList::where([['api_id', $movie],['user_id', Auth::id()]])->first();

        // ** Se obtiene los estados. ej viendo, en plan para ver , etc..
        // $stateWatchingList = WatchingState::all(['id','name']);

        // ** Se obtiene la escala de puntaje 1 a 10
        $scoreList = Score::all(['id','name']);

        $viewModel = new MovieShowViewModel(
            $movieShowDetails,
            $movieCheck,
            $scoreList
        );


        return view('movies.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
