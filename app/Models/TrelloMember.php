<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrelloMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'telegram_user_id',
        'trello_id',
        'full_name',
        'user_name',
        'email',
    ];

    public function telegramUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TelegramUser::class);
    }
}
