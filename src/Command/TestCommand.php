<?php

namespace App\Command;

use App\Entity\Notification;
use App\Enum\NotificationUrgencyEnum;
use App\Services\NotifierService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'notifier:send',
    description: 'Send a notification',
)]
class TestCommand extends Command
{
    public function __construct(protected NotifierService $service)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $notification = new Notification('Hello from the notifier command!', NotificationUrgencyEnum::HIGH);
        $status = $this->service->send($notification);

        $io->error(
            sprintf('Notification with urgency "%s" is handled by "%s"', $notification->getUrgency()->name, $status->getDeliverer())
        );

        $notification = new Notification('Hello from the notifier command!', NotificationUrgencyEnum::MEDIUM);
        $status = $this->service->send($notification);

        $io->warning(
            sprintf('Notification with urgency "%s" is handled by "%s"', $notification->getUrgency()->name, $status->getDeliverer())
        );

        $notification = new Notification('Hello from the notifier command!', NotificationUrgencyEnum::LOW);
        $status = $this->service->send($notification);

        $io->success(
            sprintf('Notification with urgency "%s" is handled by "%s"', $notification->getUrgency()->name, $status->getDeliverer())
        );

        return Command::SUCCESS;
    }
}
