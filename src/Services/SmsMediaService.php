<?php

namespace NotificationChannels\SmsMedia\Services;

use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract;
use NotificationChannels\SmsMedia\Contracts\Services\SmsMediaClientContract;
use NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageFactoryContract;
use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract;
use NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageCollectionFactoryContract;

/**
 * SMS Media Service.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class SmsMediaService
{
    /**
     * The sms media client implementation.
     *
     * @var \NotificationChannels\SmsMedia\Contracts\Services\SmsMediaClientContract
     */
    private $client;

    /**
     * The short message factory implementation.
     *
     * @var \NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageFactoryContract
     */
    private $factory;

    /**
     * The short message collection factory implementation.
     *
     * @var \NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageCollectionFactoryContract
     */
    private $collectionFactory;

    /**
     * The before callback which will be called before sending single messages.
     *
     * @var callable|null
     */
    private $beforeSingleShortMessageCallback;

    /**
     * The after callback which will be called before sending single messages.
     *
     * @var callable|null
     */
    private $afterSingleShortMessageCallback;

    /**
     * The before callback which will be called before sending multiple messages.
     *
     * @var callable|null
     */
    private $beforeMultipleShortMessageCallback;

    /**
     * The after callback which will be called after sending multiple messages.
     *
     * @var callable|null
     */
    private $afterMultipleShortMessageCallback;

    /**
     * SmsMediaService constructor.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Services\SmsMediaClientContract                 $client
     * @param \NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageFactoryContract           $factory
     * @param \NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageCollectionFactoryContract $collectionFactory
     * @param null                                                                                     $beforeSingleShortMessageCallback
     * @param null                                                                                     $afterSingleShortMessageCallback
     * @param null                                                                                     $beforeMultipleShortMessageCallback
     * @param null                                                                                     $afterMultipleShortMessageCallback
     */
    public function __construct(
        SmsMediaClientContract $client,
        ShortMessageFactoryContract $factory,
        ShortMessageCollectionFactoryContract $collectionFactory,
        $beforeSingleShortMessageCallback = null,
        $afterSingleShortMessageCallback = null,
        $beforeMultipleShortMessageCallback = null,
        $afterMultipleShortMessageCallback = null
    ) {
        $this->client = $client;
        $this->factory = $factory;
        $this->collectionFactory = $collectionFactory;
        $this->beforeSingleShortMessageCallback = $beforeSingleShortMessageCallback;
        $this->afterSingleShortMessageCallback = $afterSingleShortMessageCallback;
        $this->beforeMultipleShortMessageCallback = $beforeSingleShortMessageCallback;
        $this->afterMultipleShortMessageCallback = $afterMultipleShortMessageCallback;
    }

    /**
     * Send SMS.
     *
     * @param      $receivers
     * @param null $body
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessage($receivers, $body = null)
    {
        if (! $receivers instanceof ShortMessageContract) {
            $receivers = $this->factory->create($receivers, $body);
        }

        if (is_callable($this->beforeSingleShortMessageCallback)) {
            call_user_func_array($this->beforeSingleShortMessageCallback, [$receivers]);
        }

        $response = $this->client->sendMessage($receivers);

        if (is_callable($this->afterSingleShortMessageCallback)) {
            call_user_func_array($this->afterSingleShortMessageCallback, [$response, $receivers]);
        }

        return $response;
    }

    /**
     * Send Multiple SMS.
     *
     * @param $messages
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessages($messages)
    {
        if (! $messages instanceof ShortMessageCollectionContract) {
            $collection = $this->collectionFactory->create();

            foreach ($messages as $message) {
                $collection->push($this->factory->create(
                    $message['recipient'],
                    $message['message']
                ));
            }

            $messages = $collection;
        }

        if (is_callable($this->beforeMultipleShortMessageCallback)) {
            call_user_func_array($this->beforeMultipleShortMessageCallback, [$messages]);
        }

        $response = $this->client->sendMessages($messages);

        if (is_callable($this->afterMultipleShortMessageCallback)) {
            call_user_func_array($this->afterMultipleShortMessageCallback, [$response, $messages]);
        }

        return $response;
    }
}
