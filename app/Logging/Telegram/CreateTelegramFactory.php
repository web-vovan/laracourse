<?php

namespace App\Logging\Telegram;

use Monolog\Logger;

class CreateTelegramFactory
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return Logger
     */
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('telegram');

        $logger->pushHandler(new TelegramLoggerHandler($config));

        return $logger;
    }
}
