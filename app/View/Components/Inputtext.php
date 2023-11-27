<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Inputtext extends Component
{
    public $property;
    public function __construct($property)
    {
        $this->property = $property;
    }
    public function render()
    {
        return view('components.inputtext');
    }
}
