<?php

namespace App\Services\Telegram\Commands;

use App\Events\TelegramStartCommand;
use App\Helpers\EmailHelpers;
use App\Helpers\StrHelpers;
use App\Services\Trello\TrelloService;
use Telegram\Bot\Commands\Command;

class ReportCardTrelloCommand  extends Command
{

    public function __construct(
        public TrelloService $trelloService
    ) {}

    /**
     * @var string Command Name
     */
    protected $name = 'report';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['reportTrelloCommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Show trello cards report';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate();

        $members = $this->trelloService->getAllMembers();

        $text = "Welcome to our bot, Here are our available commands:".chr(10);

        $this->replyWithMessage(compact('text'));

    }

}
