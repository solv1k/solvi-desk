<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Dashboard\IndexAdminDashboardAction;
use App\Http\Controllers\Controller;

final class DashboardController extends Controller
{
    /**
     * Главная страница панели администратора.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexAdminDashboardAction $action)
    {
        return view('admin.dashboard.index', $action->run());
    }
}
