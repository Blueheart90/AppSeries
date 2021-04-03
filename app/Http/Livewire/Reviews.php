<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Reviews extends Component
{

    public $content;

    public function submit()
    {
        $this->validate(['content' => 'required']);
        // $this->content = "goodbye";
        Log::debug($this->content);
    }

    public function render()
    {
        return view('livewire.reviews');
    }
}
