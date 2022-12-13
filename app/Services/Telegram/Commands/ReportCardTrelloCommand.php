<?php

namespace App\Services\Telegram\Commands;

use App\Events\TelegramStartCommand;
use App\Helpers\EmailHelpers;
use App\Helpers\StrHelpers;
use App\Models\TrelloMember;
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
        $syncMember = TrelloMember::with('telegramUser')->get();

        $response = '';
        foreach ($syncMember as $item){
            $member = $this->trelloService->client->getMember($item->trello_id);
            $cards = $this->trelloService->client->getMemberCards($member->id);
            $countInProgress = 0;
            foreach ($cards as $card){
                $cardList = $this->trelloService->client->getCardList($card->id,);
                if ($cardList->name != 'Готово'){
                    $countInProgress++;
                }
            }
            $response .= sprintf('%s - %s' . PHP_EOL, $item->telegramUser->fullName, "Card In Progress: {$countInProgress} ");

        }

        $text = "Show trello cards report:".chr(10);
        $text.=$response;
        $this->replyWithMessage(compact('text'));

    }

}
