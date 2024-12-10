<?php

declare(strict_types=1);

namespace Smartheads\Application\UserMessage\Factory;

use Smartheads\Application\UserMessage\Event\ContactEmailSentEvent;
use Smartheads\Domain\Entity\UserMessage\Email;
use Smartheads\Domain\Entity\UserMessage\Message;
use Smartheads\Domain\Entity\UserMessage\Name;
use Smartheads\Domain\Entity\UserMessage\NationalIdentificationNumber;
use Smartheads\Domain\Entity\UserMessage\UserMessage;

class UserMessageFactory
{
    public function create(ContactEmailSentEvent $event): UserMessage
    {
        return new UserMessage(
            name: new Name($event->name),
            nationalIdentificationNumber: new NationalIdentificationNumber($event->nationalIdentificationNumber),
            email: new Email($event->email),
            isSent: $event->isSent,
            message: new Message($event->message),
        );
    }
}
