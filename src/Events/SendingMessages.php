<?php

namespace NotificationChannels\SmsMedia\Events;

use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract;

/**
 * Sending Multiple Message Event.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class SendingMessages
{
    /**
     * Message collection instance.
     *
     * @var \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract
     */
    public $messages;

    /**
     * SendingMessages constructor.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract $messages
     */
    public function __construct(ShortMessageCollectionContract $messages)
    {
        $this->messages = $messages;
    }
}
