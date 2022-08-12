@include('inc.form-errors')

<form action="{{ route('user.phones.store') }}" method="POST">
    @csrf

    <div class="alert alert-info">
        {{ __('Before proceeding, you need to verify your phone') }}.
    </div>

    <div class="mb-3">
        <label for="number">{{ __('Phone number') }}</label>
        <input 
            type="text"
            id="number"
            name="number"
            class="form-control"
            value="{{ old('phone', '+7') }}"
            required>
    </div>
    
    <div class="mb-3">
        <button class="btn btn-success">{{ __('Verify phone') }} <i class="bi bi-arrow-right-circle"></i></button>
    </div>    
</form>