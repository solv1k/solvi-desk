<?php

declare(strict_types=1);

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

final class LinksTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $seed = true;

    public function test_guest_advert_link_can_be_open(): void
    {
        $this->browse(static function (Browser $browser): void {
            $browser->visit(route('guest.adverts.view', 1))
                ->assertSee('Test advert #1');
        });
    }
}
