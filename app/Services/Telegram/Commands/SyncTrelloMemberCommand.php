<?php

namespace App\Services\Telegram\Commands;

use App\Services\Trello\TrelloService;
use Telegram\Bot\Commands\Command;

class SyncTrelloMemberCommand extends Command
{

    /**
     * @var string Command Name
     */
    protected $name = 'sync';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['syncTrelloCommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Sync trello account with telegram.';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $text = "Enter the /trello command and after entering the email or login from the trello account:".chr(10);
        $text.= "For example: /trello test@email".chr(10);
        $this->replyWithMessage(compact('text'));

    }

}
