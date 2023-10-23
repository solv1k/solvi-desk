<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\Dashboard\IndexDashboardAction;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

final class DashboardController extends Controller
{
    /**
     * Главная страница личного кабинета пользователя.
     */
    public function index(
        IndexDashboardAction $action
    ): View {
        return $action->run(auth()->user());
    }
}
