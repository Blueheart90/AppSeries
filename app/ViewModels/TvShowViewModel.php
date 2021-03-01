<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Facades\Http;

class TvShowViewModel extends ViewModel
{
    public $tvshow;
    public $tvCheck;
    public $stateWatchingList;
    public $scoreList;
    public $editMode;

    public function __construct($tvshow, $tvCheck, $stateWatchingList, $scoreList)
    {
        $this->tvshow = $tvshow;
        $this->tvCheck = $tvCheck;
        $this->stateWatchingList = $stateWatchingList;
        $this->scoreList = $scoreList;
        $this->editMode = isset($this->tvCheck) ? true : false;
    }

    // Si devuelve la serie creada por el User actual, si está en la DB
    public function tvCheck()
    {
        return $this->tvCheck;
    }

    public function editMode()
    {
        return $this->editMode;
    }

    public function api_flags()
    {
        // return Http::get('https://flagcdn.com/en/codes.json')
        // ->json()[$nameCode];

        return Http::get('https://restcountries.eu/rest/v2/alpha/' . "co")
        ->collect();
    }
    public function info()
    {
        return collect([
            'Primera Emision' => $this->tvshow['first_air_date'],
            'Pagina Web' => $this->tvshow['homepage'],
            'En produccion' => $this->tvshow['in_production'],
            'Estado' => $this->tvshow['status'],
            'Ultimo Capitulo' => $this->tvshow['last_episode_to_air']['air_date'],
            'Siguiente Capitulo' => $this->tvshow['next_episode_to_air']
                ? $this->tvshow['next_episode_to_air']['air_date']
                : null,
            'Compañia' => collect($this->tvshow['networks'])->pluck('name')->implode(', '),
            'Capitulos' => $this->tvshow['number_of_episodes'],
            'Temporadas' => $this->tvshow['number_of_seasons'],
            'Pais' => $this->api_flags( Str::lower($this->tvshow['origin_country'][0]) ),
            'Lenguaje Original' => $this->tvshow['original_language'],
        ]);
    }

    public function tvshow()
    {
        return collect($this->tvshow)->merge([
            'poster_path' => $this->tvshow['poster_path']
                ? 'https://www.themoviedb.org/t/p/w440_and_h660_face'.$this->tvshow['poster_path']
                : 'https://via.placeholder.com/500x750',
            'vote_average' => $this->tvshow['vote_average'] * 10,
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'cast' => collect($this->tvshow['credits']['cast'])->take(5)->map(function($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                        : 'https://via.placeholder.com/300x450',
                ]);
            }),
            'images' => collect($this->tvshow['images']['backdrops'])->take(9),
            'random_bg' => $this->tvshow['images']['backdrops']
                ? 'http://image.tmdb.org/t/p/w1280' . collect($this->tvshow['images']['backdrops'])->random()['file_path']
                : '',
            'tagline' => $this->tvshow['tagline'],
            'year' => Carbon::parse($this->tvshow['first_air_date'])->format('Y'),
            'seasons' => collect($this->tvshow['seasons'])->mapWithKeys(function ($season) {
                return [$season['season_number'] => $season['episode_count']];
            }),
            'stringEpCount' => collect($this->tvshow['seasons'])->mapWithKeys(function ($season) {
                return [$season['season_number'] => $season['episode_count']];
            })->reject(function ($value, $key) {
                // No toma el index 0, el cual equivale a los ep. espaciales
                return $key == 0;
            })->implode(','),

        ])->only([
            'poster_path', 'id', 'genres', 'name', 'vote_average', 'overview', 'first_air_date', 'credits' ,
            'videos', 'images', 'crew', 'cast', 'images', 'random_bg', 'created_by', 'tagline', 'year', 'seasons', 'stringEpCount'
        ]);
    }
}
