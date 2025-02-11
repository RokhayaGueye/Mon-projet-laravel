<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    protected $botToken;

    public function __construct()
    {
        $this->botToken = env('7884072706:AAFOwgG5HBXCXwLnUxgXNoxuViMpZpQcGdk');
    }

    
    public function sendMessage($chatId, $message)
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";
        
        $response = Http::post($url, [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        
        if ($response->successful()) {
            return $response->json();
        } else {
            
            return [
                'error' => 'Échec de l\'envoi du message.',
                'details' => $response->json(),
            ];
        }
    }
}
