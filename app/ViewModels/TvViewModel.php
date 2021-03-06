<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Str;

class TvViewModel extends ViewModel
{
    public $trendingTv;
    public $popularTv;
    public $onAirTv;
    public $topRatedTv;
    public $genres;

    public function __construct($trendingTv, $popularTv, $onAirTv, $topRatedTv, $genres)
    {
        $this->trendingTv = $trendingTv;
        $this->popularTv = $popularTv;
        $this->onAirTv = $onAirTv;
        $this->topRatedTv = $topRatedTv;
        $this->genres = $genres;
    }

    public function trendingTv()
    {
        return $this->formatTv($this->trendingTv);
    }
    public function popularTv()
    {
        return $this->formatTv($this->popularTv);
    }
    public function onAirTv()
    {
        return $this->formatTv($this->onAirTv);
    }

    public function topRatedTv()
    {
        return $this->formatTv($this->topRatedTv);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv)
    {
        return collect($tv)->map(function ($tvshow){
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => 'https://www.themoviedb.org/t/p/w440_and_h660_face/'.$tvshow['poster_path'],
                'vote_average' => $tvshow['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('M d, Y'),
                'year' => Carbon::parse($tvshow['first_air_date'])->format('Y'),
                'genres' => $genresFormatted,
                'slug' => Str::of($tvshow['name'])->slug('-'),
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date','year', 'genres', 'slug',
            ]);
        });
    }
}
