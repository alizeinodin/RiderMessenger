<?php

namespace App\Providers;

use App\Providers\SendMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\SendMessage  $event
     * @return void
     */
    public function handle(SendMessage $event)
    {
        //
    }
}
