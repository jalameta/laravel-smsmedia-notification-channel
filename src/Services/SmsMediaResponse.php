<?php

namespace NotificationChannels\SmsMedia\Services;

/**
 *
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class SmsMediaResponse
{
    private static $statuses = [
        0 => 'FAILED',
        1 => 'SUCCESS'
    ];

    protected $messages;

    protected $requestId;

    protected $status;
}