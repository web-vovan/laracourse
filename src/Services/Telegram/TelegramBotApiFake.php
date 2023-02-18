<?php

namespace Services\Telegram;

class TelegramBotApiFake implements TelegramBotApiContract
{
    public static function sendMessage(string $token, int $chatId, string $text): bool
    {
        return true;
    }
}
