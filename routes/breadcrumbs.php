<?php

use App\Models\Advert;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(__('Home'), route('guest.home'));
});

// Guest - advert view
Breadcrumbs::for('guest.adverts.view', function (BreadcrumbTrail $trail, Advert $advert) {
    $trail->parent('home');
    $trail->push(__('Advert preview'), route('guest.adverts.view', $advert->id));
});