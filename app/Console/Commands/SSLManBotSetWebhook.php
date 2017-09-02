<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SSLManBotSetWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sllman:set-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up a telegram web hook';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $webHookUrl = config('sslmanbot.webhook');
        $telegramToken = config('services.botman.telegram_token');
        $requestUrl = "https://api.telegram.org/bot{$telegramToken}/setWebhook";

        $httpClient =  new \GuzzleHttp\Client();
        $httpResponse = $httpClient->request('post', $requestUrl, [
            'form_params' => ['url' => $webHookUrl]
        ]);

        echo $httpResponse->getBody();
    }
}
