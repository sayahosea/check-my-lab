<?php

namespace App\View;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Statistics extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.statistics');
    }
}
