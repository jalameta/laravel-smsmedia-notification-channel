<?php

namespace NotificationChannels\SmsMedia\Contracts\Messages;

/**
 * Sms Collection contract
 *
 * @author      veelasky <veelasky@gmail.com>
 */
interface ShortMessageCollectionContract
{
    /**
     * Push a new short message to the given collection.
     *
     * @param \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract $shortMessage
     *
     * @return self
     */
    public function push(ShortMessageContract $shortMessage);
}