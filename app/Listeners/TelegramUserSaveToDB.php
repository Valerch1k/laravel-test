<?php

namespace App\Listeners;

use App\Events\TelegramStartCommand;
use App\Models\TelegramUser;
use App\Repositories\TelegramRepository;
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
    public function __construct(

        public TelegramRepository $repository

    ) {}

    /**
     * Handle the event.
     *
     * @param  TelegramStartCommand  $event
     * @return void
     */
    public function handle(TelegramStartCommand $event)
    {
        $this->repository->saveUserAndMessage($event->message);
    }
}
