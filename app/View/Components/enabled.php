<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Enabled extends Component
{
    /**
     * Create a new component instance.
     */
    public bool $enabled;
    public string $name;

    public function __construct($enabled = true, $name = 'enabled') {
        $this->enabled = $enabled;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.enabled');
    }
}
