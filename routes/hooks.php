<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hooks\TelegramHookController;

Route::prefix(config('token_valid.token'))->group(function (){
    Route::post('start',[TelegramHookController::class,'start']);
});
