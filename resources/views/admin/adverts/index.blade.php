<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Adverts management') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('admin.adverts.index') }}

        <div class="my-3">
            <a href="{{ route('admin.adverts.waitmoderate.list') }}">{{ __('Wait moderation') }} ({{ $newAdvertsCount }})</a>
        </div>

        <div class="my-3">
            <a href="{{ route('admin.adverts.active.list') }}">{{ __('Active adverts') }} ({{ $activeAdvertsCount }})</a>
        </div>

        <div class="my-3">
            <a href="{{ route('admin.adverts.list') }}">{{ __('All adverts') }} ({{ $advertsCount }})</a>
        </div>

    </x-slot>
</x-dashboard-layout>
