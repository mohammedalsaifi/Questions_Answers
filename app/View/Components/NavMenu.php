<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavMenu extends Component
{

    public $items;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = config('nav-menu');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-menu');
    }
}
