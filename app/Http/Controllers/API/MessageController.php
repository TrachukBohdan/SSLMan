<?php

namespace App\Http\Controllers\API;
use App\Subscriber;

use Mpociot\BotMan\Drivers\TelegramDriver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mpociot\BotMan;

class MessageController extends Controller
{
    public function publishMessage()
    {
        Subscriber::create(['telegram_user_id' => 5]);
        $botman = app('botman');
        $botman->say('Message', 112829685, TelegramDriver::class);
    }
}
