<?php

namespace NotificationChannels\SmsMedia\Messages;

use NotificationChannels\SmsMedia\Contracts\Factories\ShortMessageFactoryContract;

/**
 * SMS Factory.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class ShortMessageFactory implements ShortMessageFactoryContract
{
    /**
     * Create new short message instance.
     *
     * @param $receivers
     * @param $body
     *
     * @return \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract
     */
    public function create($receivers, $body)
    {
        return new ShortMessage($receivers, $body);
    }
}
