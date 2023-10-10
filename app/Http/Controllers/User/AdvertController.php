<?php

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
use App\Services\File\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function __construct(
        private FileService $fileService
    ){}

    /**
     * Список объявлений (в личном кабинете пользователя).
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $adverts = $request
            ->user()
            ->adverts()
            ->select('adverts.*')
            ->joinUserLike()
            ->joinSelectedUserPhone()
            ->get();

        return view('user.adverts.list', compact('adverts'));
    }

    /**
     * Список объявлений, которые понравилилсь пользователю.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function liked(Request $request)
    {
        $liked_adverts = $request->user()->likedAdverts;

        return view('user.adverts.liked', compact('liked_adverts'));
    }

    /**
     * Форма создания нового объявления.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $advert_categories = AdvertCategory::whereIsRoot()->get();

        return view('user.adverts.forms.create', compact('advert_categories'));
    }

    /**
     * Обработчик создания нового объявления.
     *
     * @return \Illuminate\Http\RedirectResponse
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
     *
     * @return \Illuminate\Http\RedirectResponse
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
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(Request $request, Advert $advert)
    {
        if (! $request->user()->can('update', $advert)) {
            return redirect(route('guest.adverts.view', $advert->id));
        }

        return view('user.adverts.single', compact('advert'));
    }

    /**
     * Страница редактирования объявления (в личном кабинете пользователя).
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(EditAdvertRequest $request, Advert $advert)
    {
        $advert_categories = AdvertCategory::whereIsRoot()->get();

        return view('user.adverts.forms.edit', compact('advert', 'advert_categories'));
    }
}
