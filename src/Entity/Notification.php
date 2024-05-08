<?php

namespace App\Entity;

use App\Enum\NotificationUrgencyEnum;

class Notification
{
    public function __construct(protected string $message, protected NotificationUrgencyEnum $urgency = NotificationUrgencyEnum::MEDIUM)
    {

    }

    public function getUrgency(): NotificationUrgencyEnum
    {
        return $this->urgency;
    }
}
