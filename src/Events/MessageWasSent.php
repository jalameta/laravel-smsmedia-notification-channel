<?php

namespace NotificationChannels\SmsMedia\Events;

use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract;

/**
 * Message was sent event
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class MessageWasSent
{
    /**
     * Sms Instance
     *
     * @var \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract
     */
    public $message;

    public $response;

    /**
     * SendingMessage constructor.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract $message
     */
    public function __construct(ShortMessageContract $message, $response)
    {
        $this->message = $message;
        $this->response = $response;
    }
}