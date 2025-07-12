<?php

namespace App\View;

use Closure;
use Illuminate\View\View;

class Edit
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.outbreak.location.edit');
    }
}
