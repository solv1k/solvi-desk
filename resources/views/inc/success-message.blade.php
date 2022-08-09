@if ($message = session()->get('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <span class="text-success"><i class="bi bi-check-circle-fill"></i></span>&nbsp;
                <strong class="me-auto">{{ __('Success') }}</strong>
                <small>{{ __('just now') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $message }}
            </div>
        </div>
    </div>

    <script>
        const toastDiv = document.getElementById('liveToast')
        const toast = new bootstrap.Toast(toastDiv)
        toast.show()
    </script>
@endif