<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Phone verification') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('user.phones.verify.page', $userPhone) }}

        <div class="alert alert-info mb-3">
            {{__('Verify phone')}} <strong>{{ $userPhone->number }}</strong> {{ __('Click "Send code" button and wait SMS code.') }}
        </div>

        @include('inc.form-errors')

        @livewire('common.phone.phone-verification-block', ['userPhone' => $userPhone])
    </x-slot>
</x-dashboard-layout>