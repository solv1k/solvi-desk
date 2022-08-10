<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    /**
     * Страница активации пользователя.
     * 
     * @return \Illuminate\Contracts\View\View
     */    
    public function index()
    {
       return view('user.dashboard.activation');
    }

    /**
     * Обработчик отправки сообщения с ссылкой активации аккаунта пользователя.
     * 
     * @return mixed
     */
    public function sendLink(Request $request)
    {
        /** @var \App\Models\User */
        $user = $request->user();

        $user->sendEmailVerificationNotification();
    }
}
