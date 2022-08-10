<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdvertEditRequest;
use App\Http\Requests\User\AdvertStoreRequest;
use App\Http\Requests\User\AdvertUpdateRequest;
use App\Models\Advert;
use App\Models\AdvertCategory;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertController extends Controller
{
    /** @var FileService */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Список объявлений (в личном кабинете пользователя).
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $adverts = $request->user()->adverts;

        return view('user.adverts.list', compact('adverts'));
    }

    /**
     * Форма создания нового объявления.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $advert_categories = AdvertCategory::all();

        return view('user.adverts.forms.create', compact('advert_categories'));
    }

    /**
     * Обработчик создания нового объявления.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdvertStoreRequest $request)
    {
        DB::beginTransaction();

        $advert = $request->user()->adverts()->create($request->only([
            'advert_category_id',
            'title',
            'description',
            'price'
        ]));

        if ($request->hasFile('image')) {
            $image_path = $this->fileService->storeImage($request->file('image'));
            $advert->setMainImage($image_path);
        }

        $advert->setWaitPhoneStatus();

        DB::commit();

        return redirect(route('user.adverts.phones.list', $advert->id));
    }

    /**
     * Обработчик обновления данных объявления.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdvertUpdateRequest $request, Advert $advert)
    {
        DB::beginTransaction();

        $advert->fill($request->only([
            'advert_category_id',
            'title',
            'description',
            'price'
        ]));

        // если модель объявления была изменена, то отправляем на модерацию
        if ($advert->isDirty([
            'advert_category_id', 
            'title', 
            'description'
        ])) {
            $advert->setModerateStatus();
        }

        $advert->save();

        // если в запросе есть изображение для объявления
        if ($request->hasFile('image')) {
            // удаляем предыдущее изображение
            if ($advert->hasMainImage()) {
                $this->fileService->deleteImage($advert->main_image_path);
            }
            // загружаем новое изображение
            $image_path = $this->fileService->storeImage($request->file('image'));
            $advert->setMainImage($image_path);
        }

        DB::commit();
        
        return redirect(
            route('user.adverts.phones.list', $advert->id)
        )->with('success', __('Advert update successfuly!'));
    }

    /**
     * Страница просмотра объявления (в личном кабинете пользователя).
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function view(Advert $advert)
    {
        return view('user.adverts.single', compact('advert'));
    }

    /**
     * Страница редактирования объявления (в личном кабинете пользователя).
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(AdvertEditRequest $request, Advert $advert)
    {
        $advert_categories = AdvertCategory::all();

        return view('user.adverts.forms.edit', compact('advert', 'advert_categories'));
    }
}
