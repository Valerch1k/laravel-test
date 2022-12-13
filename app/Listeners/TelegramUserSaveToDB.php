<?php

namespace App\Listeners;

use App\Events\TelegramStartCommand;
use App\Models\TelegramUser;
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
        try {

            $user = TelegramUser::query()->firstOrCreate([
                'telegram_id' => $event->message->from->id,
            ],[
                'is_bot' => $event->message->from->isBot,
                'first_name'=> $event->message->from->firstName,
                'last_name'=> $event->message->from->lastName,
                'username'=> $event->message->from->username,
                'language_code'=> $event->message->from->languageCode,
            ]);

            $user->messages()->create([
                'message_id' => $event->message->messageId,
                'chat_id' => $event->message->chat->id,
                'text' => $event->message->text
            ])->save();

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

    }
}
