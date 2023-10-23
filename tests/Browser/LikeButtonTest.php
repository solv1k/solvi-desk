<?php

declare(strict_types=1);

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

final class LikeButtonTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $seed = true;

    public function test_unauthorized_user_cant_like_advert(): void
    {
        $this->browse(static function (Browser $browser): void {
            $browser->visit('/')
                ->click('.advert--like-btn')
                ->waitFor('#needSignInModal', 1)
                ->assertVisible('#needSignInModal')
                ->screenshot('test_unauthorized_user_cant_like_advert');
        });
    }

    public function test_authorized_user_can_like_advert(): void
    {
        $this->browse(static function (Browser $browser): void {
            $browser->loginAs(User::find(1))
                ->visit('/')
                ->click('.advert--like-btn')
                ->waitFor('.bi-heart-fill', 3)
                ->assertSeeIn('.advert--like-counter', '1')
                ->screenshot('test_authorized_user_can_like_advert');
        });
    }
}
