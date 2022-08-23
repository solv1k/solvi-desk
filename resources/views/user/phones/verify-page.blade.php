<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Phone verification') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('user.phones.verify.page', $user_phone) }}

        <div class="alert alert-info mb-3">
            {{__('Verify phone')}} <strong>{{ $user_phone->number }}</strong> {{ __('Click "Send code" button and wait SMS code.') }}
        </div>

        @include('inc.form-errors')

        <form action="{{ route('user.phones.verify.handler', $user_phone->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="code">{{ __('Code from SMS') }}</label>
                <input 
                    type="text"
                    id="code"
                    name="code"
                    placeholder="{{ __('6-digits code') }}"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3 d-flex gap-4 align-items-center" x-data="{ codeWasSend: false }">
                <button 
                    class="btn-send-code btn btn-success" 
                    x-show="codeWasSend">
                    <i class="bi bi-save"></i> {{ __('Verify phone') }}
                </button>

                <button 
                    type="button" 
                    class="btn-send-code btn btn-success" 
                    x-show="!codeWasSend" 
                    x-on:click="codeWasSend = !codeWasSend; $store.code.timer.start();">
                    <i class="bi bi-megaphone"></i> {{ __('Send code') }}
                </button>
                
                <div class="code-timer-container text-muted" x-show="codeWasSend">
                    <span class="code-timer"></span>
                    <span
                        :class="$store.code.timer.timeIsLeft ? 'd-none' : 'd-inline-block'"
                    >{{ __('check your phone') }}</span>
                    <a 
                        href="#"
                        class="resend-code-link"
                        :class="$store.code.timer.timeIsLeft ? 'd-inline-block' : 'd-none'"
                        x-on:click="$store.code.timer.start()"
                    >{{ __('resend code') }}</a>
                </div>
            </div>

            @admin
                <div class="mb-3">CODE: {{ session('phone_verification_code_' . $user_phone->id) }}</div>
            @endadmin
        </form>
    </x-slot>
</x-dashboard-layout>