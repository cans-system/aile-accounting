<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    /**
     * Create a new component instance.
     */

    public function __construct(
        public $page
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
