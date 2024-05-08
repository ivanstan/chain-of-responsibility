<?php

namespace App\Services\Handlers;

use App\Entity\DeliveryStatus;
use App\Entity\Notification;
use App\Enum\NotificationUrgencyEnum;

class EmailNotifierHandler implements NotifierHandlerInterface
{
    /**
     * Determines if this handler should process the notification.
     *
     * This handler only supports notifications with a low urgency level.
     * Checks the urgency of the notification against a predefined low urgency level.
     *
     * @param Notification $notification The notification to check.
     * @return bool Returns true if the notification's urgency is low, false otherwise.
     */
    public function supports(Notification $notification): bool
    {
        // Check if the notification's urgency level is low
        return $notification->getUrgency() === NotificationUrgencyEnum::LOW;
    }

    /**
     * Sends the notification via email.
     *
     * This method is responsible for actually sending the notification and
     * returning the delivery status. Currently, the method needs to be fully implemented.
     *
     * @param Notification $notification The notification to send.
     * @return DeliveryStatus Returns the delivery status after attempting to send the notification.
     */
    public function send(Notification $notification): DeliveryStatus
    {
        // TODO: Implement the actual sending logic for an email notification.

        // For now, returns a new DeliveryStatus indicating the handler class that processed it.
        return new DeliveryStatus($notification, self::class);
    }
}
