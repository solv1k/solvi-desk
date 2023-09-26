<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Advert\IndexAdminAdvertAction;
use App\DTO\User\Advert\UpdateUserAdvertDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Advert\UpdateAdvertRequest;
use App\Models\Advert;
use App\Models\AdvertCategory;

class AdvertController extends Controller
{
    /**
     * Страница управления объявлениями.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexAdminAdvertAction $action)
    {
        return view('admin.adverts.index', $action->run());
    }

    /**
     * Страница со списком всех объявлений.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        $adverts = Advert::latest()->paginate(10);

        return view('admin.adverts.list', compact('adverts'));
    }

    /**
     * Страница со списком объявлений, ожидающих модерации.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function waitmoderate()
    {
        $adverts = Advert::waitModeration()->paginate(10);

        return view('admin.adverts.waitmoderate-list', compact('adverts'));
    }

    /**
     * Страница со списком объявлений, ожидающих модерации.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function active()
    {
        $adverts = Advert::active()->latest()->paginate(10);

        return view('admin.adverts.active-list', compact('adverts'));
    }

    /**
     * Страница редактирования объявления.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Advert $advert)
    {
        $advert_categories = AdvertCategory::all();

        return view('admin.adverts.forms.edit', compact('advert', 'advert_categories'));
    }

    /**
     * Обработчик обновления объявления.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAdvertRequest $request, Advert $advert)
    {
        $advert->update(UpdateUserAdvertDTO::from($request->validated())->toArray());

        return back();
    }

    /**
     * Обработчик активации объявления.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(Advert $advert)
    {
        $advert->setActiveStatus();

        return back();
    }

    /**
     * Обработчик отправки объявления на модерацию.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toModeration(Advert $advert)
    {
        $advert->sendToModeration();

        return back();
    }

    /**
     * Страница просмотра объявления (от имени администратора).
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(Advert $advert)
    {
        return view('admin.adverts.single', compact('advert'));
    }
}
