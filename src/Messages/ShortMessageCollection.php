<?php

namespace NotificationChannels\SmsMedia\Messages;

use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract;
use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract;

/**
 * Short Message collection.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class ShortMessageCollection implements ShortMessageCollectionContract
{
    /**
     * The items of the collection.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Push a new short message to the given collection.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract $shortMessage
     *
     * @return self
     */
    public function push(ShortMessageContract $shortMessage)
    {
        if ($shortMessage->hasManyReceivers()) {
            throw new \LogicException(
                'Expected one receiver per short message, got many.'
            );
        }

        $this->items[] = $shortMessage;

        return $this;
    }

    /**
     * Retrieve all items.
     *
     * @return array
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * Get the array presentation of the items.
     *
     * @return array
     */
    public function toArray()
    {
        $messages = [];
        $receivers = [];

        /** @var ShortMessage $shortMessage */
        foreach ($this->items as $shortMessage) {
            $messages[] = $shortMessage->body();
            $receivers[] = $shortMessage->receiversString();
        }

        return [
            'Msisdns' => implode('|', $receivers),
            'Messages' => implode('|', $messages),
        ];
    }
}
