<?php

namespace App\Http\Livewire;

use App\Models\Score;
use Livewire\Component;
use App\Models\MovieList;
use App\Models\WatchingState;

class DropdownAddMovieList extends Component
{
    public $open = false;
    public $editMode = false;
    public $movie;
    public $fields = [
        'watching_state_id' => 0,
        'score_id' => '0',
        'name' => '',
        'api_id' => 0,
        'poster' => '',
    ];
    public $oldData;
    public $stateWatchingList;
    public $scoreList;

    protected $rules = [
        'fields.watching_state_id' => 'gt:0',
        'fields.score_id' => 'gt:0',
        'fields.name' => 'required',
        'fields.api_id' => 'required',
        'fields.poster' => 'required',
    ];

    protected $messages = [
        'fields.watching_state_id.gt' => 'Debes seleccionar un estado',
        'fields.score_id.gt' => 'Debes asignar un puntaje',
    ];

    public function mount(){

        $this->stateWatchingList = $this->state();

        $this->scoreList = $this->score();

        $this->fields['name'] = $this->movie["name"];
        $this->fields['api_id'] = $this->movie["id"];
        $this->fields['poster'] = $this->movie["poster_path"];

        $this->checkUser();
        $this->fillFields();

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

    public function checkUser()
    {
        // Se revisa si ya el usuario tiene agregada la serie en una lista
        $this->oldData = MovieList::where('api_id', $this->fields['api_id'])->where('user_id', auth()->id())->first();

    }

    public function fillFields()
    {
        if ($this->oldData) {
            $this->editMode = true;

            // Rellenamos los campos con la info 'vieja'
            foreach ($this->fields as $key => $value) {
                $this->fields[$key] = $this->oldData->$key;
            }
        }
    }

    public function updateMovieList(MovieList $MovieList)
    {
        $MovieList->update($this->fields);
        $this->open = false;
        session()->flash('success', 'Editada exitosamente');
    }

    public function addMovieList()
    {
        $validatedData = $this->validate();
        auth()->user()->MovieLists()->create($validatedData['fields']);
        $this->checkUser();
        $this->open = false;
        $this->editMode = true;
        session()->flash('success', 'Agregada exitosamente');
    }


    public function render()
    {
        return view('livewire.dropdown-add-movie-list');
    }
}
