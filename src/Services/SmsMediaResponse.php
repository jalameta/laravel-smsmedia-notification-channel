<?php

namespace NotificationChannels\SmsMedia\Services;

/**
 *
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class SmsMediaResponse
{
    protected $messages;

    protected $requestId;

    protected $status;
    private static $statuses = [
        0 => 'FAILED',
        1 => 'SUCCESS',
    ];
}
