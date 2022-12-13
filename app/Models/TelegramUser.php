<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;

    protected $fillable =[
        'telegram_id',
        'is_bot',
        'first_name',
        'last_name',
        'username',
        'language_code'
    ];

    public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TelegramMessage::class);
    }

    public function trelloMember(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TrelloMember::class);
    }
}
