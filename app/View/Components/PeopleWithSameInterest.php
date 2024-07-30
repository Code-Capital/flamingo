<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PeopleWithSameInterest extends Component
{
    public $peoples;
    /**
     * Create a new component instance.
     */
    public function __construct($peoples)
    {
        $this->peoples = $peoples;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.people-with-same-interest');
    }
}
