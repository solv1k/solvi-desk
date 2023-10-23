<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

final class DashboardLayout extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.dashboard');
    }
}
