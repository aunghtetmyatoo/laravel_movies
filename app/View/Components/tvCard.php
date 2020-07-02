<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tvCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tvShow;
    public function __construct($tvShow)
    {
        $this->tvShow = $tvShow;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.tv-card');
    }
}
