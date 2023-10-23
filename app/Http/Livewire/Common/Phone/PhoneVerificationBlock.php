<?php

declare(strict_types=1);

namespace App\Http\Livewire\Common\Phone;

use App\Actions\User\Phone\SendVerificationUserPhoneAction;
use App\Actions\User\Phone\VerifyUserPhoneAction;
use App\Models\UserPhone;
use Livewire\Component;

final class PhoneVerificationBlock extends Component
{
    public UserPhone $userPhone;

    public string $code;

    protected $rules = [
        'code' => 'required|numeric',
    ];

    public function mount(UserPhone $userPhone): void
    {
        $this->userPhone = $userPhone;
    }

    public function render()
    {
        return view('livewire.common.phone.phone-verification-block');
    }

    public function send()
    {
        $this->code = '';

        return app_make(SendVerificationUserPhoneAction::class)
            ->run($this->userPhone);
    }

    public function verify()
    {
        $this->validate();

        $redirect = app_make(VerifyUserPhoneAction::class)
            ->run($this->userPhone, $this->code);

        if (session()->has('error')) {
            $this->addError('code', session('error'));
            session()->remove('error');
        }

        return $redirect;
    }
}
