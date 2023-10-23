<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Admin dashboard') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('admin.dashboard') }}

        <div class="mb-4">
            Welcome, {{ $current_user->name }}!
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.adverts.index') }}" class="btn btn-primary position-relative">
                <i class="bi bi-card-list"></i> {{ __('Adverts') }} ({{ $advertsCount }})

                @if ($newAdvertsCount)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $newAdvertsCount }}
                        <span class="visually-hidden">{{ __('new adverts count') }}</span>
                    </span>
                @endif
            </a>
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary position-relative">
                <i class="bi bi-tags"></i> {{ __('Categories') }} ({{ $categoriesCount }})
            </a>
        </div>

    </x-slot>
</x-dashboard-layout>