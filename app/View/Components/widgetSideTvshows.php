<?php

namespace App\View\Components;

use Illuminate\View\Component;

class widgetSideTvshows extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $topRatedTv;
    public $take;

    public function __construct($topRatedTv, $take = 3)
    {
        $this->topRatedTv = $topRatedTv;
        $this->take = $take;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.widget-side-tvshows');
    }
}
