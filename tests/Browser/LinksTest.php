<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LinksTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    protected $seed = true;

    public function test_guest_advert_link_can_be_open()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('guest.adverts.view', 1))
                    ->assertSee('Test advert #1');
        });
    }
}
