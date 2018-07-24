<?php

namespace NotificationChannels\SmsMedia\Message;

use NotificationChannels\SmsMedia\Contracts\Factory\ShortMessageFactoryContract;

/**
 * SMS Factory
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class ShortMessageFactory implements ShortMessageFactoryContract
{
    /**
     * Create new short message instance
     *
     * @param $receivers
     * @param $body
     *
     * @return \NotificationChannels\SmsMedia\Contracts\Message\ShortMessageContract
     */
    public function create($receivers, $body)
    {
        return new ShortMessage($receivers, $body);
    }
}