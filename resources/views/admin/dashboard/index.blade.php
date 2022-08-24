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
                <i class="bi bi-card-list"></i> {{ __('Adverts') }} ({{ $adverts_count }})

                @if ($new_adverts_count)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $new_adverts_count }}
                        <span class="visually-hidden">{{ __('new adverts count') }}</span>
                    </span>
                @endif
            </a>
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary position-relative">
                <i class="bi bi-tags"></i> {{ __('Categories') }} ({{ $categories_count }})
            </a>
        </div>

        <div class="mb-3">
            <a href="#" class="btn btn-primary position-relative">
                <i class="bi bi-gear"></i> {{ __('Settings') }}
            </a>
        </div>

    </x-slot>
</x-dashboard-layout>