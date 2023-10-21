<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        $update = Telegram::commandsHandler(true);

        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['0']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

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
                    'text' => 'Привет! Я ваш Telegram бот.',
                    'reply_markup' => $reply_markup, // Прикрепите клавиатуру к сообщению
                ]);
            } else {
                // Если получен другой текст, отправляем общий ответ
                Telegram::sendMessage([
                    'chat_id' => $message->getChat()->getId(),
                    'text' => 'Спасибо за ваше сообщение: ' . $text,
                    'reply_markup' => $reply_markup, // Прикрепите клавиатуру к сообщению
                ]);
            }
        }

        return 'ok';
    }
}
