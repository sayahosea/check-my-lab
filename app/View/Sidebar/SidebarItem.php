<?php

namespace App\View\Sidebar;

use Closure;
use Illuminate\View\View;

class SidebarItem
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.sidebar.item');
    }
}
