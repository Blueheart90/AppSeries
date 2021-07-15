<?php

namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class FormatTvshow {

    public $tvshow;

    public function __construct($tvshow) {

        $this->tvshow = $tvshow;

        Log::debug("desde el contructor formattvshow");
    }

    public function create() {

        Log::debug("desde el contructor formattvshow");
    }

    public function getFormatedTvshow() {

        return collect($this->tvshow)->merge([
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
            'id', 'genres', 'name', 'vote_average', 'first_air_date',
            'created_by', 'year', 'seasons', 'stringEpCount'
        ]);
    }
}
