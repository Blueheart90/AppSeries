<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\WatchingState;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\ViewModels\EditTvListViewModel;

class EditTvList extends Component
{
    public $showModal = false;
    public $tvshow;
    public $stateWatchingList;
    public $fields = [
        'watching_state_id' => 0,
        'season' => 1,
        'score_id' => 0,
        'episode' => 0,
    ];



    protected $listeners = ['prueba' => 'pruebaLog',
                            'modal' => 'modal'
                            ];


    public function mount() {
        $this->stateWatchingList = $this->state();

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


    }

    public function state()
    {
        // Se obtiene los estados. ej viendo, en plan para ver , etc..
        return WatchingState::all(['id','name']);
    }

    // public function getEpisodesForSeason($season)
    // {
    //     $this->epForSeason = $this->tvshow['seasons'][$season];
    // }


    public function pruebaLog($e){
        $this->showModal = true;
        Log::debug("prueba desde edittvlist " . $e);
    }

    public function modal($e){
        $this->showModal = true;
        $this->tvshow($e);
        Log::debug("prueba desde modal " . $this->tvshow);
    }



    public function render()
    {
        return view('livewire.edit-tv-list');
    }
}
