<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionDropdown extends Component
{
    public $model;
    public $routePrefix;

    public function __construct($model, $routePrefix)
    {
        $this->model = $model;
        $this->routePrefix = $routePrefix;
    }

    public function render()
    {
        return view('components.action-dropdown');
    }
}