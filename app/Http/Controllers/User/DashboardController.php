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
    public function index()
    {
        /** @var \App\Models\User */
        $user = auth()->user();

        $adverts_count = $user->adverts()->count();

        return view('user.dashboard.index', compact('adverts_count'));
    }
}
