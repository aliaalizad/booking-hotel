<?php

namespace App\View\Components\Panels\Header\Breadcrumb;

use Illuminate\View\Component;

class Item extends Component
{
    public $name;
    public $muted;
    public $route;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $muted = false, $route = null)
    {
        $this->name = $name;
        $this->muted = $muted == "true" ? true : false;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.panels.header.breadcrumb.item');
    }
}
