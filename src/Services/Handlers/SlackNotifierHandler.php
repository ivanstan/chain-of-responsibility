<?php

namespace App\Services\Handlers;

use App\Entity\DeliveryStatus;
use App\Entity\Notification;
use App\Enum\NotificationUrgencyEnum;

class SlackNotifierHandler implements NotifierHandlerInterface
{
    public function supports(Notification $notification): bool
    {
        return $notification->getUrgency() === NotificationUrgencyEnum::MEDIUM;
    }

    public function send(Notification $notification): DeliveryStatus
    {
        // TODO: Implement send() method.

        return new DeliveryStatus($notification, self::class);
    }
}
