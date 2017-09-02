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
    public function publishMessage()
    {
      
        $botman = app('botman');
        $botman->say('Message', 112829685, TelegramDriver::class);
    }
}
