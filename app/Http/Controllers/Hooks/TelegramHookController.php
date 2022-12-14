<?php

namespace App\Http\Controllers\Hooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramHookController extends Controller
{
    public function start(Request $request)
    {
        Log::info($request->all());
        $update = Telegram::commandsHandler(true);
        return response()->json($update);
    }

}
