<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MyList extends Component
{
    public $header;
    public $user_id;

    public function mount($username)
    {

        $this->header = 'Mi Lista';

        try {
            $this->user_id = User::where('username', $username)->firstOrFail()->id;
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'El usuario con el Username: ' . $username .' No existe');
        }
    }
    public function render()
    {
        return view('livewire.my-list')
            ->layout('layouts.app', ['header' => $this->header]);
    }
}
