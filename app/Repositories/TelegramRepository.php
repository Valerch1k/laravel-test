<?php

namespace App\Repositories;

use App\Events\TelegramStartCommand;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Message;

class TelegramRepository
{

    public function findOrCreateUser(Message $message)
    {
        try {
            return TelegramUser::query()->firstOrCreate([
                'telegram_id' => $message->from->id,
            ],[
                'is_bot' => $message->from->isBot,
                'first_name'=> $message->from->firstName,
                'last_name'=> $message->from->lastName,
                'username'=> $message->from->username,
                'language_code'=> $message->from->languageCode,
            ]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }
    }

    public function saveUserAndMessage(Message $message)
    {
        try {

            $user = TelegramUser::query()->firstOrCreate([
                'telegram_id' => $message->from->id,
            ],[
                'is_bot' => $message->from->isBot,
                'first_name'=> $message->from->firstName,
                'last_name'=> $message->from->lastName,
                'username'=> $message->from->username,
                'language_code'=> $message->from->languageCode,
            ]);

            $user->messages()->create([
                'message_id' => $message->messageId,
                'chat_id' => $message->chat->id,
                'text' => $message->text
            ])->save();

            return $user;

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }
    }

}
