<?php

declare(strict_types=1);

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Advert;

final class MainController extends Controller
{
    /**
     * Главная страница сайта.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function home()
    {
        $adverts = Advert::query()
            ->active()
            ->select('adverts.*')
            ->joinUserLike()
            ->joinSelectedUserPhone()
            ->paginate();

        return view('guest.home', compact('adverts'));
    }
}
