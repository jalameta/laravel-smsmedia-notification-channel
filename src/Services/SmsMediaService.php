<?php

namespace NotificationChannels\SmsMedia\Services;

use NotificationChannels\SmsMedia\Contracts\Services\SmsMediaClientContract;
use NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageFactoryContract;
use NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageCollectionFactoryContract;

/**
 * SMS Media Service
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class SmsMediaService
{
    /**
     * The jet sms client implementation.
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
}