<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class EditTvListViewModel extends ViewModel
{
    public $tvshow;

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;

    }

    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_url' => $this->tvshow['poster_path']
                ? 'https://www.themoviedb.org/t/p/w440_and_h660_face'.$this->tvshow['poster_path']
                : 'https://via.placeholder.com/500x750',
            'vote_average' => $this->tvshow['vote_average'] * 10,
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'year' => Carbon::parse($this->tvshow['first_air_date'])->format('Y'),
            'stringEpCount' => collect($this->tvshow['seasons'])->mapWithKeys(function ($season) {
                return [$season['season_number'] => $season['episode_count']];
            }),
            'seasons' => collect($this->tvshow['seasons'])->mapWithKeys(function ($season) {
                return [$season['season_number'] => $season['episode_count']];
            })->reject(function ($value, $key) {
                // No toma el index 0, el cual equivale a los ep. especiales
                return $key == 0;
            }),

        ])->only([
            'poster_path', 'poster_url', 'id', 'genres', 'name', 'vote_average', 'overview', 'first_air_date',
            'created_by', 'year', 'seasons', 'stringEpCount'
        ]);
    }
}
