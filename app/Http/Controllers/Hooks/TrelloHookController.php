<?php

namespace App\Http\Controllers\Hooks;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stevenmaguire\Services\Trello\Client;
use Telegram\Bot\Api;

class TrelloHookController
{
    public function start(Request $request)
    {
        Log::info($request);

        $boardName = $request->input('model.name') ?? '';
        $cardName = $request->input('action.data.card.name') ?? '';
        $event = $request->input('action.data.listAfter.name')  ?? '';

        $telegram = new Api();
        $res = $telegram->sendMessage([
            'chat_id' => config('telegram.chat_id_default'),
            'text' => "On Board: {$boardName} , card: {$cardName} status changed to {$event} "
        ]);


        return response()->json($res);
    }

}
