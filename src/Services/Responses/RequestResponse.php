<?php

namespace NotificationChannels\SmsMedia\Services;

use GuzzleHttp\Psr7\Response;

/**
 * Sms Media response object
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class RequestResponse
{
    const STATUS_DELIVERED = 1;
    const STATUS_FAILED = 0;

    protected $response;

    protected $original;

    protected $messages;

    protected $requestId;

    protected $status;

    private static $statuses = [
        0 => 'FAILED',
        1 => 'DELIVERED',
    ];

    public function __construct(Response $response)
    {
        $this->response;
    }

    protected function parseResponse()
    {
        $body = $this->response->getBody();
        $this->original = $body;

        $json = json_decode($body);

        $checks = [
            'requestId',
            'reqCode',
            'reqStatus',
            'messages'
        ];

        if (count(array_intersect_key(array_flip($checks), $json)) != count($checks))
            throw new \UnexpectedValueException('Unknown Response, failed to decode response');

        $this->requestId = $json['requestId'];
        $this->status = $json['reqCode'];
    }
}
