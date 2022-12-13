<?php

namespace App\Services\Telegram\Commands;

use App\Helpers\EmailHelpers;
use App\Helpers\StrHelpers;
use App\Repositories\TelegramRepository;
use App\Repositories\TrelloRepository;
use App\Services\Trello\TrelloService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Message;

class SaveTrelloMemberCommand extends Command
{
    public function __construct(
        public TrelloService $trelloService,
        public TelegramRepository $telegramRepository,
        public TrelloRepository $trelloRepository
    ) {}

    /**
     * @var string Command Name
     */
    protected $name = 'trello';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['trelloTrelloCommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Enter the /trello command and after entering the email or login from the trello account.';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate();

        $message = StrHelpers::removeStr('/trello',$response->message->text) ;
        $email = EmailHelpers::getEmailFromStr($message);

        if (count($email) > 0){
            $loginTrello = $email[0];
        }else{
            $loginTrello = $message;
        }

        $searchMember = $this->trelloService->searchMemberByStr($loginTrello);
        if ($searchMember){
            $this->saveToDbMember($response->message, $searchMember);
            $text = "Successfully sync trello member with telegram.Your email is {$searchMember->email}".chr(10);
        }else{
            $text= "You may have entered the data incorrectly, please try again.. ".chr(10);
        }

        $this->replyWithMessage(compact('text'));

    }

    private function saveToDbMember(Message $message, $member)
    {
        $user = $this->telegramRepository->findOrCreateUser($message);
        $member = $this->trelloRepository->findOrCreateMember($user->id,$member);

    }

}
