<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Account activation') }}
    </x-slot>
    <x-slot name="content">
        <div class="mb-3" x-data="{ verificationWasSend: false }">

            <p>{{ __('Before adding adverts and using all functionality of our service you should') }}
                <a 
                    href="#" 
                    x-show="!verificationWasSend" 
                    x-on:click="verificationWasSend = !verificationWasSend; sendActivationLink()"
                >{{ __('activate your account') }}</a>.</p>

            <p 
                x-show="verificationWasSend" 
                class="fw-bold"
            >{{ __('Check your e-mail and follow by activation link') }}.</p>

            @push('scripts')
                @include('inc.global-toast', [
                    'type' => 'success',
                    'header' => __('Success'),
                    'body' => __('E-mail message will be sent. Check your e-mail')
                ]);

                <script>
                    function sendActivationLink() {
                        axios.post("{{ route('user.activation.send-link') }}")
                            .then(() => {
                                globalToast.show();
                            });
                    }
                </script>
            @endpush
        </div>
    </x-slot>
</x-dashboard-layout>