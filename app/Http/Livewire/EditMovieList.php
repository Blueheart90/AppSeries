<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditMovieList extends Component
{
    public $showModal = false;
    public $tvshow;
    public $stateWatchingList;
    public $scoreList;
    public $fields = [
        'watching_state_id' => 0,
        'id' => 0,
        'score_id' => 0,
        'poster' => null,
    ];

    protected $rules = [
        'fields.watching_state_id' => 'gt:0',
        'fields.score_id' => 'gt:0',
    ];


    protected $listeners = ['modalMovie' => 'modal'];


    public function mount() {
        $this->stateWatchingList = $this->state();
        $this->scoreList = $this->score();

        // Se obtiene el valor de los episodes por season en la primera carga
        // $this->getEpisodesForSeason($this->fields['season']);

    }

    public function state()
    {
        // Se obtiene los estados. ej viendo, en plan para ver , etc..
        return WatchingState::all(['id','name']);
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

    public function modal($e){
        $this->showModal = true;
        $this->setFields($e);

        //  dump($e);
        // Log::debug("prueba desde modal " . $e['api_id']);

    }

    public function updateMovieList(MovieList $movieList)
    {
        $movieList->update($this->fields);
        // $this->open = false;
        session()->flash('success', 'Editada exitosamente');

        // Log::debug("tvlist: " . $tvList);
    }

    public function render()
    {
        return view('livewire.edit-movie-list');
    }
}
