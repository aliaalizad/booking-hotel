<?php

namespace App\View\Components\Tables;

use Illuminate\View\Component;

class Table extends Component
{
    public $title;
    public $data;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $data)
    {
        $this->title = $title;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.table');
    }
}