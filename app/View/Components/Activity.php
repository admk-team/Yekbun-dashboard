<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Activity extends Component
{
    public $actions;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($actions = [], $title = 'Admin Activity Timeline')
    {
        $this->actions = $actions;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.activity');
    }
}
