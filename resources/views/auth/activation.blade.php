<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Account activation') }}
    </x-slot>
    <x-slot name="content">
        <div class="mb-3 activation" x-data="activation">

            <p>{{ __('Before adding adverts and using all functionality of our service you should') }}
                <a 
                    href="javascript:void(0);"
                    x-show="!verificationWasSend"
                    x-on:click="sendActivationLink()"
                >{{ __('activate your account') }}</a></p>

            <p 
                x-show="verificationWasSend"
                class="alert alert-success fw-bold d-none"
            ><i class="bi bi-envelope-check"></i> {{ __('Check your email and follow the activation link') }}.</p>

            <p 
                x-show="hasErrors"
                class="alert alert-danger fw-bold d-none"
            ><i class="bi bi-envelope-exclamation"></i> {{ __('Ooops... Something wrong. Try repeat') }}.</p>

            @push('scripts')
                @php
                    $success_toast_id = random_int(1, 9999999);
                    $fail_toast_id = random_int(1, 9999999);
                @endphp

                @include('inc.global-toast', [
                    'id' => $success_toast_id,
                    'type' => 'success',
                    'header' => __('Success'),
                    'body' => __('Verification link was sent. Check your e-mail')
                ])

                @include('inc.global-toast', [
                    'id' => $fail_toast_id,
                    'type' => 'danger',
                    'header' => __('Error'),
                    'body' => __('Verification link was not sent. Repeat later')
                ])

                <script>
                    const activationData = {
                        verificationWasSend: false,
                        hasErrors: false,
                        prepareAlerts() {
                            const alerts = document.querySelectorAll('.activation .alert');
                            alerts.forEach(alert => {
                                alert.classList.remove('d-none');
                            });
                        },
                        sendActivationLink() {
                            this.prepareAlerts();

                            axios.post("{{ route('user.activation.send-link') }}")
                            .then(() => {
                                this.hasErrors = false;
                                this.verificationWasSend = true;
                                globalToast{{$success_toast_id}}.show();
                            })
                            .catch(() => {
                                this.hasErrors = true;
                                this.verificationWasSend = false;
                                globalToast{{$fail_toast_id}}.show();
                            });
                        }
                    };

                    document.addEventListener('alpine:init', () => {
                        Alpine.data('activation', () => (activationData));
                    });
                </script>
            @endpush
        </div>
    </x-slot>
</x-dashboard-layout>