<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdvertUpdateRequest;
use App\Models\Advert;
use App\Models\AdvertCategory;
use App\Services\FileService;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    /** @var FileService */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Страница управления объявлениями.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $adverts_count = Advert::count();
        $active_adverts_count = Advert::active()->count();
        $new_adverts_count = Advert::waitModeration()->count();

        return view('admin.adverts.index', compact(
            'adverts_count', 
            'active_adverts_count', 
            'new_adverts_count'
        ));
    }

    /**
     * Страница со списком всех объявлений.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        $adverts = Advert::paginate(10);

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
        $adverts = Advert::active()->paginate(10);

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
    public function update(AdvertUpdateRequest $request, Advert $advert)
    {
        $advert->update($request->validated());

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
