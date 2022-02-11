<?php

namespace App\View\Components\Panels\Aside;

use Illuminate\View\Component;

class MenuAccordion extends Component
{

    public $name;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $icon)
    {
        $this->name = $name;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.panels.aside.menu-accordion');
    }
}
