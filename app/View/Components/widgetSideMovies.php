<?php

namespace App\View\Components;

use Illuminate\View\Component;

class widgetSideMovies extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $topRatedMovie;
    public $take;

    public function __construct($topRatedMovie, $take = 3)
    {
        $this->topRatedMovie = $topRatedMovie;
        $this->take = $take;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.widget-side-movies');
    }
}
