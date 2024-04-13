<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    /**
     * Create a new component instance.
     */

    public $page;

    public function __construct()
    {
        dd(parse_url(URL::current(), PHP_URL_PATH));
        $path_array = explode('/', substr(parse_url(URL::current(), PHP_URL_PATH), 1));

        $this->page = Page::where('path', $path_array[1])->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
