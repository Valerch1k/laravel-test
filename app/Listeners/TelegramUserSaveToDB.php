<?php

namespace App\Listeners;

use App\Events\TelegramStartCommand;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class TelegramUserSaveToDB
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
     * @param  TelegramStartCommand  $event
     * @return void
     */
    public function handle(TelegramStartCommand $event)
    {
        Log::info('start event ----------');
        Log::info($event->message);
    }
}
