<?php

namespace Tests\Browser;

use App\Models\Advert;
use App\Models\User;
use App\Models\UserPhone;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LikeButtonTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $seed = true;

    public function test_unauthorized_user_cant_like_advert()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('.advert--like-btn')
                    ->waitFor('#needSignInModal', 1)
                    ->assertVisible('#needSignInModal')
                    ->screenshot('test_unauthorized_user_cant_like_advert');
        });
    }

    public function test_authorized_user_can_like_advert()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/')
                    ->click('.advert--like-btn')
                    ->waitFor('.bi-heart-fill', 3)
                    ->assertSeeIn('.advert--like-counter', '1')
                    ->screenshot('test_authorized_user_can_like_advert');
        });
    }
}
