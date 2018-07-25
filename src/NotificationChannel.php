<?php

namespace NotificationChannels\SmsMedia;

use Illuminate\Notifications\Notification;
use NotificationChannels\SmsMedia\Exceptions\MissingRecipientException;
use NotificationChannels\SmsMedia\Contracts\Messages\ShortMessageContract;

/**
 * SMS Media Notification Channel.
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class NotificationChannel
{
    /**
     * Send message through notification channel.
     *
     * @param                                        $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\SmsMedia\Exceptions\MissingRecipientException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSmsMedia($notifiable);

        /** @var \NotificationChannels\SmsMedia\Services\SmsMediaService $service */
        $service = app('sms-media');

        if ($message instanceof ShortMessageContract) {
            $service->sendMessage($message);

            return;
        }

        $to = $notifiable->routeNotificationFor('SmsMedia');

        if (empty($to)) {
            throw new MissingRecipientException();
        }

        $service->sendMessage($to, $message);
    }
}
