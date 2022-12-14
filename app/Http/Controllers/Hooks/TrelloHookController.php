<?php

namespace App\Http\Controllers\Hooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Stevenmaguire\Services\Trello\Client;
use Telegram\Bot\Api;

class TrelloHookController extends Controller
{
    public function start(Request $request)
    {
        Log::info($request);

        $boardName = $request->input('model.name') ?? '';
        $cardName = $request->input('action.data.card.name') ?? '';
        $event = $request->input('action.data.listAfter.name')  ?? false;

        if ($event){
            $telegram = new Api();
            $res = $telegram->sendMessage([
                'chat_id' => config('telegram.chat_id_default'),
                'text' => "On Board: {$boardName} , card: {$cardName} status changed to {$event} "
            ]);
        }
        return response()->noContent(Response::HTTP_OK);
    }

}
