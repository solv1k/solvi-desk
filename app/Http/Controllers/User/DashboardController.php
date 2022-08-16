<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Главная страница личного кабинета пользователя.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $adverts_count = $user->adverts()->count();
        $liked_adverts_count = $user->likedAdverts()->count();

        $view = view('user.dashboard.index', compact('adverts_count', 'liked_adverts_count'));

        $verified = $request->has('verified');

        // если пользователь перешёл после верификации аккаунта
        if ($verified) {
            $welcome_message = __('Welcome') . ", {$user->name}! " . __('Your account was activated.');

            return redirect(route('user.dashboard'))
                    ->with('success', $welcome_message);
        }

        return $view;
    }
}
