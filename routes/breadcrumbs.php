<?php

declare(strict_types=1);

use App\Models\Advert;
use App\Models\AdvertCategory;
use App\Models\UserPhone;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Guest - main (home)
Breadcrumbs::for('home', static function (BreadcrumbTrail $trail): void {
    $trail->push(__('Home'), route('guest.home'));
});

// Guest - advert view
Breadcrumbs::for('guest.adverts.view', function (BreadcrumbTrail $trail, Advert $advert): void {
    $trail->parent('home');
    $trail->push(__('Advert preview'), route('guest.adverts.view', $advert->id));
});

// User - dashboard
Breadcrumbs::for('user.dashboard', static function (BreadcrumbTrail $trail): void {
    $trail->push(__('Dashboard'), route('user.dashboard'));
});

// User - adverts list
Breadcrumbs::for('user.adverts.list', function (BreadcrumbTrail $trail): void {
    $trail->parent('user.dashboard');
    $trail->push(__('My adverts'), route('user.adverts.list'));
});

// User - advert preview
Breadcrumbs::for('user.adverts.view', function (BreadcrumbTrail $trail, Advert $advert): void {
    $trail->parent('user.adverts.list');
    $trail->push(__('Advert page'), route('user.adverts.view', $advert->id));
});

// User - advert create
Breadcrumbs::for('user.adverts.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('user.dashboard');
    $trail->push(__('Advert creation'), route('user.adverts.create'));
});

// User - advert edit
Breadcrumbs::for('user.adverts.edit', function (BreadcrumbTrail $trail, Advert $advert): void {
    $trail->parent('user.adverts.view', $advert);
    $trail->push(__('Advert edit'), route('user.adverts.edit', $advert->id));
});

// User - advert phone attach
Breadcrumbs::for('user.adverts.phones.attach', function (BreadcrumbTrail $trail, Advert $advert): void {
    $trail->parent('user.adverts.edit', $advert);
    $trail->push(__('Advert phone attach'), route('user.adverts.phones.attach', $advert->id));
});

// User - liked adverts list
Breadcrumbs::for('user.adverts.liked', function (BreadcrumbTrail $trail): void {
    $trail->parent('user.dashboard');
    $trail->push(__('Liked adverts'), route('user.adverts.liked'));
});

// User - adding new phone
Breadcrumbs::for('user.phones.attach', function (BreadcrumbTrail $trail): void {
    $trail->parent('user.dashboard');
    $trail->push(__('Adding new phone'), route('user.phones.attach'));
});

// User - phone verification page
Breadcrumbs::for('user.phones.verify.page', function (BreadcrumbTrail $trail, UserPhone $userPhone): void {
    $trail->parent('user.phones.attach');
    $trail->push(__('Verify phone'), route('user.phones.verify.page', $userPhone->id));
});

// Admin - dashboard
Breadcrumbs::for('admin.dashboard', static function (BreadcrumbTrail $trail): void {
    $trail->push(__('Admin dashboard'), route('admin.dashboard'));
});

// Admin - adverts index
Breadcrumbs::for('admin.adverts.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.dashboard');
    $trail->push(__('Adverts'), route('admin.adverts.index'));
});

// Admin - adverts list
Breadcrumbs::for('admin.adverts.list', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.adverts.index');
    $trail->push(__('Adverts list'), route('admin.adverts.list'));
});

// Admin - advert edit
Breadcrumbs::for('admin.adverts.edit', function (BreadcrumbTrail $trail, Advert $advert): void {
    $trail->parent('admin.adverts.list');
    $trail->push(__('Advert edit'), route('admin.adverts.edit', $advert->id));
});

// Admin - categories index
Breadcrumbs::for('admin.categories.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.dashboard');
    $trail->push(__('Categories'), route('admin.categories.index'));
});

// Admin - category view \ edit
Breadcrumbs::for('admin.categories.view', function (BreadcrumbTrail $trail, AdvertCategory $advertCategory): void {
    $trail->parent('admin.categories.index');
    $trail->push(__('Edit category'), route('admin.categories.view', $advertCategory->id));
});
