<?php

namespace App\Services;

use App\Entity\DeliveryStatus;
use App\Entity\Notification;
use App\Services\Handlers\NotifierHandlerInterface;

class NotifierService
{
    /**
     * Holds an iterable collection of notification handlers.
     * Each handler must implement the NotifierHandlerInterface.
     *
     * @var iterable|NotifierHandlerInterface[]
     */
    private iterable $handlers;

    /**
     * Constructor for the NotifierService.
     * Initializes the service with a set of notification handlers.
     *
     * @param iterable $handlers An iterable set of handlers that can send notifications.
     */
    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * Sends a notification through the first supporting handler.
     *
     * Iterates over each handler to check if it can handle the given notification,
     * and if so, uses it to send the notification.
     * If no handler supports the notification, a RuntimeException is thrown.
     *
     * @param Notification $notification The notification to be sent.
     * @return DeliveryStatus The status of the notification delivery.
     * @throws \RuntimeException If no handler supports the notification.
     */
    public function send(Notification $notification): DeliveryStatus
    {
        foreach ($this->handlers as $handler) {
            // Check if the current handler supports the notification
            if ($handler->supports($notification) === false) {
                continue; // Skip to the next handler if not supported
            }

            // If supported, send the notification using the current handler and return the status
            try {
                return $handler->send($notification);
            } catch (\Exception $exception) {
                // In case of an exception, log it and continue to the next handler
                continue;
            }
        }

        // Throw an exception if no handlers support the notification
        throw new \RuntimeException('No handler found for notification');
    }
}
