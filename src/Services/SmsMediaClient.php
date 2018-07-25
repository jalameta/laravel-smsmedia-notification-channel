<?php

namespace NotificationChannels\SmsMedia\Services;

use GuzzleHttp\Client;
use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract;
use NotificationChannels\SmsMedia\Contracts\Services\SmsMediaClientContract;
use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract;

/**
 * SMS Media Client.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class SmsMediaClient implements SmsMediaClientContract
{
    /**
     * Http Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Sender information.
     *
     * @var string
     */
    protected $from;

    /**
     * SmsMediaClient constructor.
     *
     * @param      $url
     * @param      $from
     * @param      $credentials
     * @param bool $verify
     */
    public function __construct($url, $from, $credentials, $verify = true)
    {
        $this->httpClient = $this->createHttpClient($url, $credentials, $verify);
    }

    /**
     * Send single text message.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract $message
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessage(ShortMessageContract $message)
    {
        $response = $this->httpClient->request('POST', '/api/sms/1/text/single', [
            'json' => $this->prepareMessage($message),
        ]);

        /*
         * Todo: abstract this to specific response object;
         */
        return $response;
    }

    /**
     * Send multiple text messages on a collections.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract $collection
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessages(ShortMessageCollectionContract $collection)
    {
        $messages = [];
        foreach ($collection->items() as $item) {
            if ($item instanceof ShortMessageContract) {
                $messages[] = $this->prepareMessage($item);
            }
        }
        $response = $this->httpClient->request('POST', '/api/sms/1/text/multi', [
            'json' => [
                'messages' => $messages,
            ],
        ]);

        /*
         * Todo: abstract this to specific response object;
         */
        return $response;
    }

    /**
     * Prepare text message data.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract $message
     *
     * @return array
     */
    protected function prepareMessage(ShortMessageContract $message)
    {
        return [
            'from' => $this->from,
            'to' => $message->receivers(),
            'text' => $message->body(),
        ];
    }

    /**
     * Create new Http Client.
     *
     * @param $url
     * @param $credentials
     * @param $verify
     *
     * @return \GuzzleHttp\Client
     */
    protected function createHttpClient($url, $credentials, $verify)
    {
        $options = [
            'base_uri' => $url,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic '.$credentials,
            ],
            'verify' => (parse_url($url)['scheme'] == 'http' or ! $verify) ? false : true,
        ];

        return new Client($options);
    }
}
