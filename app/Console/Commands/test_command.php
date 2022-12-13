<?php

namespace App\Console\Commands;

use App\Services\Trello\TrelloService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Stevenmaguire\Services\Trello\Client;
use Telegram\Bot\Api;

class test_command extends Command
{

    public function __construct(
        public TrelloService $trelloService
    )
    {
        parent::__construct();
    }

    protected $signature = 'test_command';

    protected $description = 'Test description';

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle(): int
    {

//        $trelloService = new TrelloService();
        $members = $this->trelloService->getAllMembers();

        dd('stop');
        $telegram = new Api();
        // chanel id -1001773491481
        // bot id 5383851478
        // hook id 6398ada19ff2f902293c6c89
        $url = 'https://5b9f-83-8-142-114.eu.ngrok.io/hook/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI/telegram/start';
        $this->setHook($telegram,$url);

        return Command::SUCCESS;
    }

    public function trelloHookGet()
    {
        $client = new Client(array(
            'key' => config('trello.key'),
            'token' => config('trello.token'),
        ));

        $boards = $client->getCurrentUserBoards();
        $cards = $client->getCurrentUserCards();
        $organizations = $client->getCurrentUserOrganizations();

        $webhook = $client->getTokenWebhooks( config('trello.token'));
        Log::info('id trello');
    }

    public function trelloDeleteHook($id)
    {
        $client = new Client(array(
            'key' => config('trello.key'),
            'token' => config('trello.token'),
        ));
        $webhook = $client->deleteWebhook($id);

    }

    public function trelloHookCreate()
    {
        $client = new Client(array(
            'key' => config('trello.key'),
            'token' => config('trello.token'),
        ));

        $webhook = $client->addWebhook([
            'callbackURL' => 'https://5b9f-83-8-142-114.eu.ngrok.io/hook/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI/trello/start',
            'idModel' => '63988cc2ba090e007667d0d2',
        ]);
        Log::info('id trello');
    }

    public function getWebHookInfo(Api $telegram)
    {
        $res = $telegram->getWebhookInfo();

        $this->info($res);
    }

    public function deleteHook(Api $telegram)
    {
        $res = $telegram->deleteWebhook();

        $this->info($res);
    }

    public function setHook(Api $telegram, string $url)
    {
        $res = $telegram->setWebhook([
            'url' => $url
        ]);

        $this->info($res);
    }

    public function sendMessage(Api $telegram)
    {
        $res = $telegram->sendMessage([
            'chat_id' => '-1001773491481',
            'text' => 'test message'
        ]);

        $this->info($res);
    }

}
