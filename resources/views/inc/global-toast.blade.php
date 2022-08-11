<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="globalToast{{ $id }}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="text-{{ $type }}"><i class="bi bi-exclamation-circle-fill"></i></span>&nbsp;
            <strong class="me-auto">{{ $header }}</strong>
            <small>{{ __('just now') }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ $body }}
        </div>
    </div>
</div>

<script>
    const toastDiv{{ $id }} = document.getElementById('globalToast{{ $id }}')
    const globalToast{{ $id }} = new bootstrap.Toast(toastDiv{{ $id }})
</script>