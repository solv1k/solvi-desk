<?php

declare(strict_types=1);

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

final class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function test_application_main_page_can_be_open(): void
    {
        $this->browse(static function (Browser $browser): void {
            $browser->visit('/')
                ->assertSee('Laravel');
        });
    }
}
