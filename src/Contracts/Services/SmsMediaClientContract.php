<?php

namespace NotificationChannels\SmsMedia\Contracts\Services;

use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract;
use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract;

/**
 * SMS media client contract.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
interface SmsMediaClientContract
{
    /**
     * Send single text message.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract $message
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessage(ShortMessageContract $message);

    /**
     * Send multiple text messages on a collections.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract $collection
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessages(ShortMessageCollectionContract $collection);
}
