<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DropdownGenres extends Component
{
    public $genres;


    // public function mount ($genres)
    // {
    //     $this->genres = $genres;
    // }
    public function render()
    {
        return view('livewire.dropdown-genres');
    }
}
