<?php

namespace App\Http\Controllers\User;

use App\Actions\User\Phone\SendVerificationUserPhoneAction;
use App\Actions\User\Phone\StoreUserPhoneAction;
use App\Actions\User\Phone\VerifyUserPhoneAction;
use App\DTO\User\Phone\StoreUserPhoneDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Phone\CancelVerifyUserPhoneRequest;
use App\Http\Requests\User\Phone\SendVerificationUserPhoneRequest;
use App\Http\Requests\User\Phone\StoreUserPhoneRequest;
use App\Http\Requests\User\Phone\VerifyUserPhoneRequest;
use App\Models\UserPhone;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserPhoneController extends Controller
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
     * 
     * @return \Illuminate\Http\RedirectResponse
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
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function verifySender(
        SendVerificationUserPhoneRequest $request,
        UserPhone $userPhone,
        SendVerificationUserPhoneAction $action
    ): View {
        $result = $action->run($userPhone);

        return ($result instanceof RedirectResponse)
            ? $result
            : view('user.phones.forms.verify-page', compact('userPhone'));
    }

    /**
     * Обработчик верификации номера телефона.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyHandler(
        VerifyUserPhoneRequest $request,
        UserPhone $userPhone,
        VerifyUserPhoneAction $action
    ): RedirectResponse {
        return $action->run(
            userPhone: $userPhone,
            code: $request->code
        );
    }

    /**
     * Отмена верификации номера телефона.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyCancel(
        CancelVerifyUserPhoneRequest $request,
        UserPhone $userPhone
    ): RedirectResponse {
        $userPhone->delete();
        return back();
    }
}
