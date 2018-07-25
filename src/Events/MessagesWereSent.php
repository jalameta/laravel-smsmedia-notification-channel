<?php

namespace NotificationChannels\SmsMedia\Events;

use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract;

/**
 * Messages were sent event.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class MessagesWereSent
{
    /**
     * Message collection instance.
     *
     * @var \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract
     */
    public $messages;

    public $response;

    /**
     * MessagesWereSent constructor.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract $messages
     * @param                                                                                  $response
     */
    public function __construct(ShortMessageCollectionContract $messages, $response)
    {
        $this->messages = $messages;
        $this->response = $response;
    }
}
