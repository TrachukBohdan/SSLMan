<?php

namespace App\Http\Controllers\API;
use App\Subscriber;

use Mpociot\BotMan\Drivers\TelegramDriver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mpociot\BotMan;
use PHPUnit\Runner\Exception;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;
use Spatie\SslCertificate\SslCertificate;


class MessageController extends Controller
{

    /**
     * Send message to subscribers
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function publishMessage(Request $request)
    {
        $botman = app('botman');

        $telegramUsers = Subscriber::all();

        foreach($telegramUsers as $telegramUser)
        {
            //todo: check sending
            $botman->say($request->message, $telegramUser->telegram_user_id, TelegramDriver::class);
        }

        return response()->json([
            'ok' => true
        ]);
    }
}
