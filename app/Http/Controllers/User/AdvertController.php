<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\Advert\StoreUserAdvertAction;
use App\Actions\User\Advert\UpdateUserAdvertAction;
use App\DTO\User\Advert\StoreUserAdvertDTO;
use App\DTO\User\Advert\UpdateUserAdvertDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Advert\UpdateAdvertRequest;
use App\Http\Requests\User\Advert\EditAdvertRequest;
use App\Http\Requests\User\Advert\StoreAdvertRequest;
use App\Models\Advert;
use App\Models\AdvertCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class AdvertController extends Controller
{
    /**
     * Список объявлений (в личном кабинете пользователя).
     */
    public function index(Request $request): View
    {
        $adverts = $request
            ->user()
            ->adverts()
            ->select('adverts.*')
            ->joinUserLike()
            ->joinSelectedUserPhone();

        return view('user.adverts.list', compact('adverts'));
    }

    /**
     * Список объявлений, которые понравилилсь пользователю.
     */
    public function liked(Request $request): View
    {
        $likedAdverts = $request->user()->likedAdverts;

        return view('user.adverts.liked', compact('likedAdverts'));
    }

    /**
     * Форма создания нового объявления.
     */
    public function create(): View
    {
        $advertCategories = AdvertCategory::whereIsRoot()->get();

        return view('user.adverts.forms.create', compact('advertCategories'));
    }

    /**
     * Обработчик создания нового объявления.
     */
    public function store(
        StoreAdvertRequest $request,
        StoreUserAdvertAction $action
    ): RedirectResponse {
        $advert = $action->run(
            user: request()->user(),
            dto: StoreUserAdvertDTO::from($request->validated())
        );

        return redirect(route('user.adverts.phones.list', $advert->id))
            ->with('success', __('Advert created successfuly!'));
    }

    /**
     * Обработчик обновления данных объявления.
     */
    public function update(
        UpdateAdvertRequest $request,
        Advert $advert,
        UpdateUserAdvertAction $action
    ): RedirectResponse {
        $updatedAdvert = $action->run(
            advert: $advert,
            dto: UpdateUserAdvertDTO::from($request->validated())
        );

        return redirect(
            route('user.adverts.phones.list', $updatedAdvert->id)
        )->with('success', __('Advert update successfuly!'));
    }

    /**
     * Страница просмотра объявления (в личном кабинете пользователя).
     */
    public function view(Request $request, Advert $advert): View|RedirectResponse
    {
        if (! $request->user()->can('update', $advert)) {
            return redirect(route('guest.adverts.view', $advert->id));
        }

        return view('user.adverts.single', compact('advert'));
    }

    /**
     * Страница редактирования объявления (в личном кабинете пользователя).
     */
    public function edit(EditAdvertRequest $request, Advert $advert): View
    {
        return view('user.adverts.forms.edit', compact('advert'));
    }
}
