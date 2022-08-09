<x-dashboard-layout>
    <x-slot name="title">
        {{ __('All adverts') }}
    </x-slot>
    <x-slot name="content">
        @forelse ($adverts as $advert)
            @include('admin.inc.advert-row', compact('advert'))
        @empty
            <div class="alert alert-info">
                {{ __('Has no adverts...') }}
            </div>
        @endforelse

        {{ $adverts->links() }}
    </x-slot>
</x-dashboard-layout>