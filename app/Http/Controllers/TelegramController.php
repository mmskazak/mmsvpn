<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        $update = Telegram::commandsHandler(true);

        // Получение входящего сообщения
        $message = $update->getMessage();

        if ($message) {
            // Извлекаем текст сообщения
            $text = $message->getText();

            // Определяем, какой текст ожидаем
            if ($text === '/start') {
                // Если получена команда /start, отправляем приветственное сообщение
                Telegram::sendMessage([
                    'chat_id' => $message->getChat()->getId(),
                    'text' => 'Привет! Я ваш Telegram бот.'
                ]);
            } else {
                // Если получен другой текст, отправляем общий ответ
                Telegram::sendMessage([
                    'chat_id' => $message->getChat()->getId(),
                    'text' => 'Спасибо за ваше сообщение: ' . $text
                ]);
            }
        }

        return 'ok';
    }
}