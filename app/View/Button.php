<?php

namespace App\View;

use Closure;
use Illuminate\View\View;

class Button
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
