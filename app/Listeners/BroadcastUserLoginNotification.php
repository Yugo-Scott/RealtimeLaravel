<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;
use App\Events\UserSessionChanged;

class BroadcastUserLoginNotification
{
    /**
     * Create the event listener. listen to the event and broadcast it as a notification
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        Broadcast(new UserSessionChanged($event->user->name . ' has logged in', 'success')); //"{$event->user->name}", 'success'));
    }
}
