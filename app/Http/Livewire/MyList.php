<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class MyList extends Component
{
    public $header;
    public $user_id;

    public function mount($username)
    {
        $this->user_id = User::where('username', $username)->first()->id;
        $this->header = 'Mi Lista';
        Log::debug("message:" . $this->user_id);
    }
    public function render()
    {
        return view('livewire.my-list')
            ->layout('layouts.app', ['header' => $this->header]);
    }
}
