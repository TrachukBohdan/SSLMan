<?php

namespace App\Http\Controllers\WebHooks;

use App\Subscriber;
use Illuminate\Http\Request;
use Mpociot\BotMan\BotMan;
use App\Http\Controllers\Controller;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate;
use Spatie\SslCertificate\SslCertificate;

/**
 * Class TelegramController
 * @package App\Http\Controllers\WebHooks
 */
class TelegramController extends Controller
{
    /**
     * BotMan instance
     * @var \Illuminate\Foundation\Application|mixed|null
     */
    private $botman = null;

    /**
     * List of listeners
     * @var array
     */
    private $listeners = [
        'subscribe',
        'unsubscribe',
        'status',
        'sslInfo'
    ];

    /**
     * TelegramController constructor.
     */
    public function __construct()
    {
        $this->botman = app('botman');
    }

    /**
     * Entry point to the telegram webhook
     * @param Request $request
     */
    public function getUpdates(Request $request)
    {
        foreach ($this->listeners as $listener)
        {
            call_user_func([$this, $listener]);
        }

        $this->botman->listen();
    }

    /**
     * Subscribe user to updates
     */
    private function subscribe()
    {
        $this->botman->hears('subscribe', function (BotMan $bot) {
            $userId = $bot->getUser()->getId();
            $user = Subscriber::where('telegram_user_id', $userId)->first();
            $userMsg = 'You are already subscribed';

            if(is_null($user))
            {
                Subscriber::create(['telegram_user_id' => $userId]);
                $userMsg = 'You have just subscribed to our updates!';
            }

            $bot->reply($userMsg);
        });
    }

    /**
     * Unsubscribe user from updates
     */
    private function unsubscribe()
    {
        $this->botman->hears('unsubscribe', function(BotMan $bot) {
            $userId = $bot->getUser()->getId();
            Subscriber::where('telegram_user_id', $userId)->delete();
            $bot->reply('You have just unsubscribed from our updates!');
        });
    }

    /**
     * Return subscribing status of user
     */
    private function status()
    {
        $this->botman->hears('status', function(BotMan $bot) {

            $status = 'subscribed';
            $user = Subscriber::where('telegram_user_id', $bot->getUser()->getId())->first();

            if(is_null($user))
            {
                $status = 'unsubscribed';
            }

            $bot->reply('status: '. $status);
        });
    }

    /**
     * Check ssl info of the domain
     */
    private function sslInfo()
    {
        $this->botman->hears('ssl-info {domain}', function(BotMan $bot, $domain) {

            $domainInfoMsg = '';

            try
            {
                $certificate = SslCertificate::createForHostName($domain);
                $domainInfo['valid'] = $certificate->isValid() ? 'yes' : 'no';
                $domainInfo['issuer'] = $certificate->getIssuer();
                $domainInfo['exp-data'] = $certificate->expirationDate();
                $domainInfo['sig-algorithm'] = $certificate->getSignatureAlgorithm();

                foreach($domainInfo as $propertyName => $propertyValue)
                {
                    $domainInfoMsg .= "\n{$propertyName}: \t $propertyValue";
                }
            }
            catch(CouldNotDownloadCertificate $e)
            {
                $domainInfoMsg = 'Error: check the domain please';
            }

            $bot->reply($domainInfoMsg);
        });
    }
}
