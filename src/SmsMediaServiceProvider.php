<?php

namespace NotificationChannels\SmsMedia;

use Illuminate\Support\ServiceProvider;
use NotificationChannels\SmsMedia\Messages\ShortMessage;
use NotificationChannels\SmsMedia\Services\SmsMediaClient;
use NotificationChannels\SmsMedia\Services\SmsMediaService;
use NotificationChannels\SmsMedia\Messages\ShortMessageFactory;
use NotificationChannels\SmsMedia\Messages\ShortMessageCollection;
use NotificationChannels\SmsMedia\Messages\ShortMessageCollectionFactory;
use NotificationChannels\SmsMedia\Contracts\Services\SmsMediaClientContract;

/**
 * Sms Media Service Provider.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class SmsMediaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerClient();
        $this->registerService();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'sms-media',
            SmsMediaClientContract::class,
        ];
    }

    /**
     * Register SMS Media Http Client.
     *
     * @return void
     */
    private function registerClient()
    {
        $this->app->bind(SmsMediaClientContract::class, function () {
            $config = config('services.smsmedia');

            if (empty($config['base_url'])) {
                throw new \UnexpectedValueException('SMS Media Base Url cannot be null or empty');
            }

            $token = $config['credentials']['token'];
        
            switch ($config['mode']) {
                case 'auth':
                    if (empty($config['credentials']['username']) or empty($config['credentials']['password']))
                        throw new \UnexpectedValueException('SMS Media username and/or password cannot be null or empty');
                
                    $token = base64_encode($config['credentials']['username'].':'.$config['credentials']['password']);
                    break;
                case 'token':
                    if (empty($token))
                        throw new \UnexpectedValueException('SMS Media Token cannot be null or empty');
                    break;
                default:
                    throw new \UnexpectedValueException('Invalid SMS Media configuration value');
            }

            $client = new SmsMediaClient($config['base_url'], $config['sender_id'], $token);

            return $client;
        });
    }

    /**
     * Register SMS Media Service.
     *
     * @return void
     */
    private function registerService()
    {
        $beforeSingle = function (ShortMessage $message) {
            event(new Events\SendingMessage($message));
        };

        $afterSingle = function ($response, ShortMessage $message) {
            event(new Events\MessageWasSent($message, $response));
        };

        $beforeMany = function (ShortMessageCollection $messages) {
            event(new Events\SendingMessages($messages));
        };

        $afterMany = function ($response, ShortMessageCollection $messages) {
            event(new Events\MessagesWereSent($messages, $response));
        };

        $this->app->singleton('sms-media', function ($app) use ($beforeSingle, $afterSingle, $beforeMany, $afterMany) {
            return new SmsMediaService(
                $app->make(SmsMediaClientContract::class),
                new ShortMessageFactory(),
                new ShortMessageCollectionFactory(),
                $beforeSingle,
                $afterSingle,
                $beforeMany,
                $afterMany
            );
        });
    }
}
