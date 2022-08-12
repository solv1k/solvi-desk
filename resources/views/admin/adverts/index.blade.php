<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Adverts management') }}
    </x-slot>
    <x-slot name="content">

        <div class="my-3">
            <a href="{{ route('admin.adverts.waitmoderate.list') }}">{{ __('New adverts') }} ({{ $new_adverts_count }})</a>
        </div>

        <div class="my-3">
            <a href="{{ route('admin.adverts.active.list') }}">{{ __('Active adverts') }} ({{ $active_adverts_count }})</a>
        </div>

        <div class="my-3">
            <a href="{{ route('admin.adverts.list') }}">{{ __('All adverts') }} ({{ $adverts_count }})</a>
        </div>
    
    </x-slot>
</x-dashboard-layout>