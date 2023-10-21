<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TestController extends Controller
{
    public function test() {
        $response = Telegram::bot('mybot')->getMe();
        dd($response);
    }
}
