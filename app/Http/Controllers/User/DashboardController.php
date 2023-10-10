<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Dashboard\IndexDashboardAction;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Главная страница личного кабинета пользователя.
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(
        IndexDashboardAction $action
    ): View {
        return $action->run(auth()->user());
    }
}
