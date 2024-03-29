<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Adverts wait moderate') }}
    </x-slot>
    <x-slot name="content">

        {{ Breadcrumbs::render('admin.adverts.list') }}

        @forelse ($adverts as $advert)
            @include('admin.adverts.inc.advert-row', compact('advert'))
        @empty
            <div class="alert alert-info">
                {{ __('Has no new adverts...') }}
            </div>
        @endforelse

        {{ $adverts->links() }}
    </x-slot>
</x-dashboard-layout>
