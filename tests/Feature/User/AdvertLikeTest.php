<?php

declare(strict_types=1);

namespace Tests\Feature\User;

use App\Http\Livewire\User\Adverts\LikeButton;
use App\Models\Advert;
use App\Models\AdvertStatTotal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

final class AdvertLikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_main_page_is_open_correctly(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_like_advert(): void
    {
        /** @var \App\Models\User */
        $user = User::factory()->create();

        $advert = Advert::factory()
            ->hasOwner($user)
            ->create();

        $this->actingAs($user);

        $livewire_component = Livewire::test(LikeButton::class, compact('advert'));

        // FIRST CLICK

        $livewire_component->call('toggle');

        $this->assertTrue(AdvertStatTotal::where('advert_id', $advert->id)->exists());

        $advert_stat = AdvertStatTotal::where('advert_id', $advert->id)->first();

        $this->assertTrue($advert_stat->likes === 1);

        // SECOND CLICK

        $livewire_component->call('toggle');

        $advert_stat = AdvertStatTotal::where('advert_id', $advert->id)->first();

        $this->assertTrue($advert_stat->likes === 0);
    }
}
