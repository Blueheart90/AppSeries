<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\TvList;
use Livewire\Component;
use App\Models\MovieList;
use Illuminate\Support\Facades\DB;

class TableList extends Component
{
    public $tab;
    public $userId;
    public $prueba;


    public $sortField = 'name';
    public $sortDirection = 'asc';
    public  $tableH = [
        'Name' => 'name',
        'Score' => 'score_id',
        'Type' => 'type',
        'Season' => 'season',
        'Episode' => 'episode',
    ];
    public $watchingColors = [
        1 => 'green',
        2 => 'blue',
        3 => 'yellow',
        4 => 'red',
        5 => 'gray'
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];


    public function sortBy($field)
    {
        if ($this->sortField == $field) {
           $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc' ;
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function render()
    {
        // // $tv = MovieList::where('api_id', 615457);
        // $lists = TvList::where('user_id', 1)->orderBy('score_id', 'asc')->get();

        if ($this->tab == 0) {

            $tv = TvList::where('user_id', $this->userId)
                ->select(['id', 'name', 'api_id', 'poster', 'watching_state_id', 'score_id', 'season', 'episode'])
                ->selectRaw('"TvShow" as type');

            $lists = MovieList::where('user_id', $this->userId)
                ->select(['id', 'name', 'api_id', 'poster', 'watching_state_id', 'score_id'])
                ->selectRaw('Null as season, NULL as episode, "Movie" as type')
                ->union($tv)
                ->orderBy($this->sortField, $this->sortDirection)
                ->get();
        } else {

            $tv = TvList::where([['user_id', $this->userId],['watching_state_id', $this->tab ]])
                ->select(['id', 'name', 'api_id', 'poster', 'watching_state_id', 'score_id', 'season', 'episode'])
                ->selectRaw('"TvShow" as type');

            $lists = MovieList::where([['user_id', $this->userId], ['watching_state_id', $this->tab]])
                ->select(['id', 'name', 'api_id', 'poster', 'watching_state_id', 'score_id'])
                ->selectRaw('Null as season, NULL as episode, "Movie" as type')
                ->union($tv)
                ->orderBy($this->sortField, $this->sortDirection)
                ->get();
        }

        return view('livewire.table-list', compact('lists'));
    }
}
