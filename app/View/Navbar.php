<?php

namespace App\View;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Navbar extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
