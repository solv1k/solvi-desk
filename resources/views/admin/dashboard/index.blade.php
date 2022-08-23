<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Admin dashboard') }}
    </x-slot>
    <x-slot name="content">
        <div class="mb-4">
            Welcome, mr. Admin!
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.adverts.index') }}" class="btn btn-primary position-relative">
                {{ __('Adverts') }} ({{ $adverts_count }})
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $new_adverts_count }}
                    <span class="visually-hidden">{{ __('new adverts count') }}</span>
                </span>
            </a>
        </div>

        <div class="mb-3">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary position-relative">
                {{ __('Categories') }} ({{ $categories_count }})
            </a>
        </div>

    </x-slot>
</x-dashboard-layout>