<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class titre extends Component
{
    public $titre;
    /**
     * Create a new component instance.
     */
    public function __construct($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.titre');
    }
}
