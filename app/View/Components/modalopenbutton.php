<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalopenbutton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $target, public $disabled=false)
    {
        $this->target = $target;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modalopenbutton');
    }
}
