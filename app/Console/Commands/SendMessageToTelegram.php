<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TelegramController;

class SendMessageToTelegram extends Command
{
    protected $signature = 'telegram:birthday';
    protected $description = 'Отправка поздравлений с днем рождения в Telegram';

    public function handle()
    {
        app(TelegramController::class)->sendMessage();
    }
}
