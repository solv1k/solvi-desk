<form action="{{ route('user.phones.store') }}" method="POST">
    @csrf

    <div class="alert alert-info">
        {{ __('You need validate your phone before continue') }}
    </div>

    <input 
        type="text"
        id="number"
        name="number"
        class="form-control"
        value="{{ old('phone', '+7') }}">
    
    <div class="my-4">
        <button class="btn btn-success">{{ __('Attach phone') }}</button>
    </div>    
</form>