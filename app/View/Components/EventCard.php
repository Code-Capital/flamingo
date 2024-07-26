<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventCard extends Component
{
    public $event;

    public $user;

    public $url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($event, $user = null, $url = null)
    {
        $this->event = $event;
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.event-card');
    }
}
