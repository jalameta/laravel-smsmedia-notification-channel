<?php

namespace NotificationChannels\SmsMedia\Contracts\Message;

/**
 * Short message contract
 *
 * @author      veelasky <veelasky@gmail.com>
 */
interface ShortMessageContract
{
    /**
     * Get the body of the short message.
     *
     * @return string
     */
    public function body();

    /**
     * Determine if the short message has many receivers or not.
     *
     * @return bool
     */
    public function hasManyReceivers();

    /**
     * Get the receivers of the short message.
     *
     * @return array
     */
    public function receivers();

    /**
     * Get the receivers of the short message as concatenated string.
     *
     * @param  string|null $glue
     * @return string
     */
    public function receiversString($glue = null);

    /**
     * Get the array representation of the short message.
     *
     * @return array
     */
    public function toArray();
}