<?php

use App\Http\Controllers\Hooks\TrelloHookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hooks\TelegramHookController;

Route::prefix(config('hook_token.token'))->group(function (){

    Route::prefix('telegram')->as('telegram.')->group(function () {
        Route::post('start',[TelegramHookController::class,'start']);
    });

    Route::prefix('trello')->as('trello.')->group(function () {
        Route::any('start',[TrelloHookController::class,'start']);
    });

});
