<x-guest-layout>
    <x-slot name="content">  
        @if (count($adverts) > 0)
            <div class="advert-list row">
                @foreach ($adverts as $advert)
                    <div class="col-sm-6">
                        @include('guest.inc.advert', compact('advert'))
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">{{ __('Ooops... Adverts not found.') }}</div>
        @endif
    </x-slot>
</x-guest-layout>