<?php

namespace App\Listeners\Auth;

class MarkUserAsActivated
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        /** @var \App\Models\User */
        $user = $event->user;

        if ($user && $user->hasVerifiedEmail()) {
            $user->giveActivatedPermissions();
        }
    }
}
