<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use Telegram\Bot\Api;

class test_command extends Command
{

    protected $signature = 'test_command';

    protected $description = 'Test description';

    /**
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle(): int
    {

        $telegram = new Api();
        // chanel id -1001773491481
        // bot id 5383851478
        $url = 'https://d333-83-8-142-114.eu.ngrok.io/hook/eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI/start';
        $this->setHook($telegram, $url);

        return Command::SUCCESS;
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
