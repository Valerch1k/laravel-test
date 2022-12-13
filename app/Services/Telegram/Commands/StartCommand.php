<?php

namespace App\Services\Telegram\Commands;

use App\Events\TelegramStartCommand;
use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['startcommands'];

    /**
     * @var string Command Description
     */
    protected $description = 'Start command, Get a list of all commands';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate();
        $firstName = $response->message->from->firstName ?? $response->channelPost->senderChat->title ?? '';
        $lastName = $response->message->from->lastName ?? '';

        $text = "Hey {$firstName} {$lastName}, thanks for visiting me.".chr(10);

        TelegramStartCommand::dispatch($response->message);

        $this->replyWithMessage(compact('text'));

    }

}
