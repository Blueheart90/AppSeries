<?php

namespace App\Http\Livewire;

use App\Models\Score;
use App\Models\TvList;
use Livewire\Component;
use App\Classes\FormatTvshow;
use App\Models\WatchingState;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\ViewModels\EditTvListViewModel;

class EditTvList extends Component
{
    public $showModal = false;
    public $tvshow;
    public $stateWatchingList;
    public $epForSeason;
    public $scoreList;
    public $fields = [
        'watching_state_id' => 0,
        'id' => 0,
        'season' => 1,
        'episode' => 1,
        'score_id' => 0,
        'poster' => null,
    ];

    protected $rules = [
        'fields.watching_state_id' => 'gt:0',
        'fields.season' => 'required',
        'fields.score_id' => 'gt:0',
        'fields.episode' => 'required'
    ];


    protected $listeners = ['modal' => 'modal'];


    public function mount() {
        $this->stateWatchingList = $this->state();
        $this->scoreList = $this->score();

        // Se obtiene el valor de los episodes por season en la primera carga
        // $this->getEpisodesForSeason($this->fields['season']);

    }

    public function tvshow($apiId)
    {
        // Querys
        $language = 'en-US';


        // Detalles de la Serie
        $tvShowDetails = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/tv/' . $apiId)
            ->json();

        $format = new FormatTvshow($tvShowDetails);
        $this->tvshow = $format->getFormatedTvshow();

        // @dump($format->getFormatedTvshow());

    }

    public function state()
    {
        // Se obtiene los estados. ej viendo, en plan para ver , etc..
        return WatchingState::all(['id','name']);
    }

    public function getEpisodesForSeason($season)
    {
        $this->epForSeason = $this->tvshow['seasons'][$season];
    }

    public function score()
    {
        // ** Se obtiene la escala de puntaje 1 a 10
        return Score::all(['id','name']);
    }

    public function setFields($fields)
    {
       $this->fields = $fields;
    }

    public function completeTvshow()
    {
        $this->fields['season'] = count($this->tvshow['seasons']);
        $this->getEpisodesForSeason($this->fields['season']);
        $this->fields['episode'] = $this->epForSeason;
    }

    public function modal($e){
        $this->showModal = true;
        $this->setFields($e);
        $this->tvshow($e['api_id']);
        $this->getEpisodesForSeason($this->fields['season']);

        //  dump($e);
        // Log::debug("prueba desde modal " . $e['api_id']);

    }

    public function updateTvList(TvList $tvList)
    {
        $tvList->update($this->fields);
        // $this->open = false;
        session()->flash('success', 'Editada exitosamente');

        // Log::debug("tvlist: " . $tvList);
    }



    public function render()
    {
        return view('livewire.edit-tv-list');
    }
}
