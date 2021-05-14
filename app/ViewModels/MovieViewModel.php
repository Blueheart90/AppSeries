<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $trendingMovie;
    public $popularMovie;
    public $nowPlayingMovie;
    public $topRatedMovie;
    public $genres;

    public function __construct($trendingMovie, $popularMovie, $nowPlayingMovie, $topRatedMovie, $genres)
    {
        $this->trendingMovie = $trendingMovie;
        $this->popularMovie = $popularMovie;
        $this->nowPlayingMovie = $nowPlayingMovie;
        $this->topRatedMovie = $topRatedMovie;
        $this->genres = $genres;
    }

    public function trendingMovie()
    {
        return $this->formatMovie($this->trendingMovie);
    }
    public function popularMovie()
    {
        return $this->formatMovie($this->popularMovie);
    }
    public function nowPlayingMovie()
    {
        return $this->formatMovie($this->nowPlayingMovie);
    }

    public function topRatedMovie()
    {
        return $this->formatMovie($this->topRatedMovie);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovie($tv)
    {
        return collect($tv)->map(function ($tvshow){
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => 'https://www.themoviedb.org/t/p/w440_and_h660_face/'.$tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($tvshow['release_date'])->format('M d, Y'),
                'year' => Carbon::parse($tvshow['release_date'])->format('Y'),
                'genres' => $genresFormatted,
                'name' => $tvshow['title'],
                'slug' => Str::of($tvshow['title'])->slug('-'),
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'name', 'vote_average', 'overview', 'release_date','year', 'genres', 'slug',
            ]);
        });
    }
}
