<?php

namespace App\Services\Handlers;

use App\Entity\DeliveryStatus;
use App\Entity\Notification;

interface NotifierHandlerInterface
{
    public function supports(Notification $notification): bool;

    public function send(Notification $notification): DeliveryStatus;
}
