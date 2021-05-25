<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MyList extends Component
{
    public $header;

    public function mount()
    {
       $this->header = 'Mi Lista';
    }
    public function render()
    {
        return view('livewire.my-list')
            ->layout('layouts.app', ['header' => $this->header]);
    }
}
