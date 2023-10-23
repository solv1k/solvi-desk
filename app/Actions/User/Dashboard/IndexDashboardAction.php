<?php

declare(strict_types=1);

namespace App\Actions\User\Dashboard;

use App\Models\User;
use Illuminate\Contracts\View\View;

final class IndexDashboardAction
{
    /**
     * Возвращает данные для главной страницы пользователя.
     */
    public function run(User $user): View
    {
        $advertsCount = $user->adverts()->count();
        $likedAdverts_count = $user->likedAdverts()->count();

        $view = view('user.dashboard.index', compact(
            'advertsCount',
            'likedAdverts_count'
        ));

        // если пользователь перешёл после верификации аккаунта
        if (request()->has('verified')) {
            $welcome_message = __('Welcome') . ", {$user->name}! " . __('Your account was activated.');

            return $view->with('success', $welcome_message);
        }

        return $view;
    }
}
