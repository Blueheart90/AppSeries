<?php

namespace App\View\Components;

use App\Models\Score;
use App\Models\WatchingState;
use Illuminate\View\Component;

class DropdownFormList extends Component
{
    public $tvshow;
    public $stateWatchingList;
    public $scoreList;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
        $this->stateWatchingList = $this->state();
        $this->scoreList = $this->score();
    }

    public function state()
    {
        // ** Se obtiene los estados. ej viendo, en plan para ver , etc..
        return WatchingState::all(['id','name']);
    }
    public function score()
    {
        // ** Se obtiene la escala de puntaje 1 a 10
        return Score::all(['id','name']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.dropdown-form-list');
    }
}
