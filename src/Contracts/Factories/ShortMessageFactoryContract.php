<?php

namespace NotificationChannels\SmsMedia\Contracts\Factories;

/**
 * SMS Factory Contract.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
interface ShortMessageFactoryContract
{
    /**
     * Create new short message instance.
     *
     * @param $receivers
     * @param $body
     *
     * @return \NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract
     */
    public function create($receivers, $body);
}
