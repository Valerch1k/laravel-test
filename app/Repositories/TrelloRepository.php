<?php

namespace App\Repositories;

use App\Models\TrelloMember;

class TrelloRepository
{

    public function findOrCreateMember($userId,$member): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return TrelloMember::query()->firstOrCreate([
            'trello_id' => $member->id,
        ],[
            'telegram_user_id' => $userId,
            'trello_id' => $member->id,
            'full_name' => $member->fullName,
            'user_name' => $member->username,
            'email' => $member->email
        ]);
    }

}
