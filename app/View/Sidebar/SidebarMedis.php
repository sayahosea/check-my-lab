<?php

namespace App\View\Sidebar;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class SidebarMedis extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.sidebar.medis');
    }
}
