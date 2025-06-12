<?php

namespace App\View\Sidebar;

use Closure;
use Illuminate\View\View;

class SidebarLab
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.sidebar.lab');
    }
}
