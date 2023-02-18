<?php

namespace Tests\Unit\Services\Telegram;

use Illuminate\Support\Facades\Http;
use Services\Telegram\TelegramBotApi;
use Services\Telegram\TelegramBotApiContract;
use Tests\TestCase;

class TelegramBotApiTest extends TestCase
{
    public function test_send_message_success()
    {
        TelegramBotApi::fake();

        $result = app(TelegramBotApiContract::class)::sendMessage('', '1', 'testing');

        $this->assertTrue($result);
    }
}
