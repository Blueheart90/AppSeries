<?php

namespace App\View\Components;

use Illuminate\View\Component;

class widgetGenres extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $genres;

    public function __construct($genres)
    {
        $this->genres = $genres;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.widget-genres');
    }
}
