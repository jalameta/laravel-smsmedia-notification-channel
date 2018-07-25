<?php

namespace NotificationChannels\SmsMedia\Events;

use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract;

/**
 * Sending Message event.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class SendingMessage
{
    /**
     * Sms Instance.
     *
     * @var \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract
     */
    public $message;

    /**
     * SendingMessage constructor.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract $message
     */
    public function __construct(ShortMessageContract $message)
    {
        $this->message = $message;
    }
}
