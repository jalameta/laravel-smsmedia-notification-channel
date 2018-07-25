<?php

namespace NotificationChannels\SmsMedia\Messages;

use NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageCollectionFactoryContract;

/**
 * Short Message Collection Factory.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class ShortMessageCollectionFactory implements ShortMessageCollectionFactoryContract
{
    /**
     * Create a new short message collection.
     *
     * @return \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract
     */
    public function create()
    {
        return new ShortMessageCollection();
    }
}
