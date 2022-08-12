<x-dashboard-layout>
    <x-slot name="title">
        {{ __('Advert page') }}
    </x-slot>
    <x-slot name="content">

        <div class="advert-page">
            <div class="advert row">
                <div class="col-lg-4">
                    <div class="advert--status" style="max-width: 400px;">
                        @include('admin.inc.advert-status-changer', compact('advert'))
                    </div>
                    <div class="mb-3">
                        <div class="advert--image">
                            <img 
                                src="{{ $advert->main_image_url }}" 
                                alt="{{ $advert->title }}" 
                                style="width: 380px;"
                                class="img-fluid rounded">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="advert--info">
                        <div class="d-flex align-items-start gap-3">
                            <div class="advert--title fs-4">
                                {{ $advert->title }}
                            </div>
                            @admin
                                <a href="{{ route('admin.adverts.edit', $advert->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Edit') }}</a>
                            @endadmin
                        </div>
                        <div class="advert--category text-muted mb-3">
                            {{ __('Category') }}: {{ $advert->category?->title }}
                        </div>
                        <div class="advert--price fs-3 fw-bold mb-4">
                            {{ price_format($advert->price) }} {{ GeneralSetting::getValue('currency_symbol') }}
                        </div>
    
                        <hr>
                        
                        <div class="advert--description mb-3" style="max-width: 360px;">
                            {!! $advert->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-dashboard-layout>
