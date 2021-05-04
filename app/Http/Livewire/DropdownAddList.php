<?php

namespace App\Http\Livewire;

use App\Models\Score;
use App\Models\TvList;
use Livewire\Component;
use App\Models\WatchingState;
use Illuminate\Support\Facades\Log;

class DropdownAddList extends Component
{
    public $open = false;
    public $editMode = false;
    public $tvshow;
    public $fields = [
        'watching_state_id' => 0,
        'season' => 1,
        'score_id' => 0,
        'episode' => 0,
        'name' => '',
        'api_id' => 0,
        'poster' => '',
    ];
    public $oldData;
    public $stateWatchingList;
    public $epForSeason;
    public $scoreList;


    public function mount(){

        $this->stateWatchingList = $this->state();

        // Se obtiene el valor de los episodes por season en la primera carga
        $this->getEpisodesForSeason($this->fields['season']);

        $this->scoreList = $this->score();

        $this->fields['name'] = $this->tvshow["name"];
        $this->fields['api_id'] = $this->tvshow["id"];
        $this->fields['poster'] = $this->tvshow["poster_path"];

        $this->checkUser();
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

    public function completeTvshow()
    {
        $this->fields['season'] = count($this->tvshow['seasons']);
        $this->getEpisodesForSeason($this->fields['season']);
        $this->fields['episode'] = $this->epForSeason;
    }

    public function score()
    {
        // ** Se obtiene la escala de puntaje 1 a 10
        return Score::all(['id','name']);
    }

    public function checkUser()
    {
        // Se revisa si ya el usuario tiene agregada la serie en una lista
        $this->oldData = TvList::where('api_id', $this->fields['api_id'])->where('user_id', auth()->id())->first();
        if ($this->oldData) {
            $this->editMode = true;

            // Rellenamos los campos con la info 'vieja'
            foreach ($this->fields as $key => $value) {
                $this->fields[$key] = $this->oldData->$key;
            }
        }
    }

    public function updateTvList(TvList $tvList)
    {
        $tvList->update($this->fields);
        $this->open = false;
    }

    public function addTvList()
    {
        auth()->user()->tvlists()->create($this->fields);
        session()->flash('message', 'Agregada exitosamente');
        $this->open = false;
        $this->checkUser();
    }

    public function render()
    {
        return view('livewire.dropdown-add-list');
    }
}
