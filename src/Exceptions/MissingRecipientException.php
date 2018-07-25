<?php

namespace NotificationChannels\SmsMedia\Exceptions;

/**
 * Missing Recipient Exception.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class MissingRecipientException extends \Exception
{
    /**
     * Construct the exception. Note: The message is NOT binary safe.
     *
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param \Throwable $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        if (empty($message)) {
            $message = 'The recipient of the sms message is missing.';
        }

        parent::__construct($message, $code, $previous);
    }
}
