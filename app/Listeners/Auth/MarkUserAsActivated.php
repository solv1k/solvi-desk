<?php

declare(strict_types=1);

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Verified;

final class MarkUserAsActivated
{
    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        /** @var \App\Models\User */
        $user = $event->user;

        if ($user->hasVerifiedEmail()) {
            // даём права доступа
            $user->giveActivatedPermissions();
        }
    }
}
