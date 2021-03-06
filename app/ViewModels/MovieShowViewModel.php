<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MovieShowViewModel extends ViewModel
{
    public $movie;
    public $movieCheck;
    public $scoreList;
    public $editMode;

    // Se retiró $stateWatchingList del contructor, ya que se obtiene en el componente del dropDownform o el de livewire
    public function __construct($movie, $movieCheck, $scoreList)
    {
        $this->movie = $movie;
        $this->movieCheck = $movieCheck;
        $this->scoreList = $scoreList;
        $this->editMode = isset($this->movieCheck) ? true : false;
    }

    public function timeToHoursMinutes($time, $format = '%02dh %02dmin')
    {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    // Devuelve la serie creada por el User actual, si está en la DB
    public function movieCheck()
    {
        return $this->movieCheck;
    }

    public function editMode()
    {
        return $this->editMode;
    }

    public function codeToLanguage($codeLang)
    {
        if (Storage::exists( 'json/languages.json')) {
            $languages = json_decode(Storage::get('json/languages.json'), true);
        }

        // name o  nativeName
        return $languages[$codeLang]['name'];
    }

    public function info()
    {
        return collect([
            'Titulo original' => $this->movie['original_title'],
            'Estreno' => Carbon::parse($this->movie['release_date'])->isoFormat('MMMM D, YYYY'),
            'Pagina Web' => '<a class=" hover:text-blue-800 hover:font-bold" href="' . $this->movie['homepage'] . '">Sitio Oficial</a>' ,
            'Estado' => $this->movie['status'],
            'Presupuesto' => $this->movie['budget'] == 0 ? 'No disponible' : '$' . number_format($this->movie['budget']),
            'Ingresos' => $this->movie['revenue'] == 0 ? 'No disponible' : '$' . number_format($this->movie['revenue']),
            'Lenguaje Original' => $this->codeToLanguage($this->movie['original_language'])
        ]);
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_url' => $this->movie['poster_path']
                ? 'https://www.themoviedb.org/t/p/w440_and_h660_face'.$this->movie['poster_path']
                : 'https://via.placeholder.com/500x750',
            'vote_average' => $this->movie['vote_average'] * 10,
            'imdb_link' => 'https://www.imdb.com/title/' . $this->movie['imdb_id'] ,
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'runtime' => $this->timeToHoursMinutes($this->movie['runtime']),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'name' => $this->movie['title'],
            'cast' => collect($this->movie['credits']['cast'])->take(10)->map(function($cast) {
                return collect($cast)->merge([
                    'profile_path' => $cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w300'.$cast['profile_path']
                        : 'https://via.placeholder.com/300x450',
                ]);
            }),
            'crew' => collect($this->movie['credits']['crew'])->where('job', 'Director'),
            'director' => collect($this->movie['credits']['crew'])->where('job', 'Director'),
            'screenplay' => collect($this->movie['credits']['crew'])->where('job', 'Screenplay'),
            'images' => collect($this->movie['images']['backdrops'])->take(9),
            'backdrops' => collect($this->movie['images']['backdrops'])->take(5)->map(function($bd) {
                return collect($bd)->merge([
                    'thumbnail' => 'https://image.tmdb.org/t/p/w300/' . $bd['file_path'],
                    'w780' => 'https://image.tmdb.org/t/p/w780/' . $bd['file_path'],
                    'w1280' => 'https://image.tmdb.org/t/p/w1280/' . $bd['file_path'],
                    'original' => 'https://image.tmdb.org/t/p/original/' . $bd['file_path'],
                    'caption' => 'Resolution: ' . $bd['width'] . 'x' . $bd['height'],
                ]);
            }),
            'videos' => collect($this->movie['videos']['results'])->take(5)->map(function($video) {
                return collect($video)->merge([
                    'url' => $video['site'] === 'YouTube'
                        ? 'https://www.youtube.com/watch?v=' . $video['key']
                        : $video['key'],
                ]);
            }),
            'random_bg' => $this->movie['images']['backdrops']
                ? 'http://image.tmdb.org/t/p/w1280' . collect($this->movie['images']['backdrops'])->random()['file_path']
                : '',
            'tagline' => $this->movie['tagline'],
            'year' => Carbon::parse($this->movie['release_date'])->format('Y'),

        ])->only([
            'poster_path', 'poster_url', 'id', 'genres', 'name', 'vote_average', 'imdb_link', 'overview', 'release_date', 'runtime', 'credits' ,
            'videos', 'images', 'backdrops', 'crew', 'director', 'screenplay', 'cast', 'images', 'random_bg', 'tagline', 'year'
        ]);
    }
}
