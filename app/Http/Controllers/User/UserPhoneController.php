<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\Phone\StoreUserPhoneAction;
use App\DTO\User\Phone\StoreUserPhoneDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Phone\CancelVerifyUserPhoneRequest;
use App\Http\Requests\User\Phone\StoreUserPhoneRequest;
use App\Models\UserPhone;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class UserPhoneController extends Controller
{
    /**
     * Список всех телефонов пользователя.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user.phones.list');
    }

    /**
     * Страница добавления нового телефона.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function attach()
    {
        return view('user.phones.forms.attach');
    }

    /**
     * Обработчик сохранения нового телефона пользователя.
     */
    public function store(
        StoreUserPhoneRequest $request,
        StoreUserPhoneAction $action
    ): RedirectResponse {
        // добавляем новый телефон юзеру (или получаем ранее созданный)
        $phone = $action->run(
            user: auth()->user(),
            dto: StoreUserPhoneDTO::from($request->validated())
        );

        // редиректим на страницу верификации телефона
        return redirect(route('user.phones.verify.page', $phone->id));
    }

    /**
     * Отправка кода верификации телефона.
     */
    public function verificationPage(UserPhone $userPhone): View
    {
        return view('user.phones.forms.verify-page', compact('userPhone'));
    }

    /**
     * Отмена верификации номера телефона.
     */
    public function verificationCancel(
        CancelVerifyUserPhoneRequest $request,
        UserPhone $userPhone
    ): RedirectResponse {
        $request->validated();
        $userPhone->delete();

        return back();
    }
}
