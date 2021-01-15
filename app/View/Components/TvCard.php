<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TvCard extends Component
{
    public $tvshow;
    public $isslider;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tvshow, $isslider = false)
    {
        //
        $this->tvshow = $tvshow;
        $this->isslider = $isslider;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.tv-card');
    }
}
