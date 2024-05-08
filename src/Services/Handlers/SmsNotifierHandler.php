<?php

namespace App\Services\Handlers;

use App\Entity\DeliveryStatus;
use App\Entity\Notification;
use App\Enum\NotificationUrgencyEnum;

class SmsNotifierHandler implements NotifierHandlerInterface
{
    public function supports(Notification $notification): bool
    {
        return $notification->getUrgency() === NotificationUrgencyEnum::HIGH;
    }

    public function send(Notification $notification): DeliveryStatus
    {
        // TODO: Implement send() method.

        return new DeliveryStatus($notification, self::class);
    }
}
