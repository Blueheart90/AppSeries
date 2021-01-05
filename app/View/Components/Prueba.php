<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Prueba extends Component
{
    public $color;

    public function __construct($color = 'orange')
    {
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.prueba');
    }
}
