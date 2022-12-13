<?php

namespace App\Http\Controllers\Hooks;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramHookController
{
    public function start(Request $request)
    {
        Log::info($request->all());
        $update = Telegram::commandsHandler(true);
        return response()->json($update);
    }

}
