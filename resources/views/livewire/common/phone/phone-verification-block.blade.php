<div>
    <div x-data>
        <div class="mb-3">
            <label for="code">{{ __('Code from SMS') }}</label>
            <input 
                type="text"
                id="code"
                name="code"
                placeholder="{{ __('6-digits code') }}"
                class="form-control"
                required
                wire:model="code">
        </div>

        <div class="mb-3 d-flex gap-4 align-items-center">
            <button 
                type="button"
                class="btn-send-code btn btn-success"
                x-show="!$store.common.smsCodeTimer.show"
                x-on:click="$store.common.smsCodeTimer.start()"
                wire:click="send">
                <i class="bi bi-megaphone"></i> {{ __('Send code') }}
            </button>
            @error('code') <span class="error">{{ $message }}</span> @enderror

            <button
                class="btn-send-code btn btn-success"
                x-show="$store.common.smsCodeTimer.show"
                wire:click="verify">
                <i class="bi bi-check"></i> {{ __('Verify phone') }}
            </button>
            
            <div class="code-timer-container text-muted" x-show="$store.common.smsCodeTimer.show && !$store.common.smsCodeTimer.timeIsLeft">
                <span class="code-timer" wire:ignore>00:30</span>
                <span>{{ __('time remaining until retry') }}</span>
            </div>
            <div class="code-timer-container text-muted" x-show="$store.common.smsCodeTimer.timeIsLeft">
                <span>now you can</span> 
                <a 
                    href="javascript:void(0)"
                    x-on:click="$store.common.smsCodeTimer.start()"
                    wire:click="send"
                >{{ __('send new code') }}</a>
            </div>
        </div>
    </div>
</div>
