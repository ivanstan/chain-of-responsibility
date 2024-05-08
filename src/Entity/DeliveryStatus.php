<?php

namespace App\Entity;

class DeliveryStatus
{
    public function __construct(
        protected Notification $original,
        protected string       $deliverer,
    )
    {
    }

    public function getDeliverer(): string
    {
        return $this->deliverer;
    }
}
