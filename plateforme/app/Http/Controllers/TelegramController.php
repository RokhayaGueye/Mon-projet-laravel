<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;

class TelegramController extends Controller
{
    public function sendMessageTest()
    {
        $telegramService = new TelegramService();
        $chatId = 5526275769; 
        $message = 'Ceci est un message test via Telegram.';
        $telegramService->sendMessage($chatId, $message);
        
        return 'Message envoyé !';
    }
}
