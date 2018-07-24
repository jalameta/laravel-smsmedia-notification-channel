<?php

namespace NotificationChannels\SmsMedia\Contracts\Factories;

/**
 * SMS collection Factory contract
 *
 * @author      veelasky <veelasky@gmail.com>
 */
interface ShortMessageCollectionFactoryContract
{
    /**
     * Create a new short message collection.
     *
     * @return \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageCollectionContract
     */
    public function create();
}