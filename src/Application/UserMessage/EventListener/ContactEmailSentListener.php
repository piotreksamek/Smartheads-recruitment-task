<?php

declare(strict_types=1);

namespace Smartheads\Application\UserMessage\EventListener;

use Smartheads\Application\UserMessage\Event\ContactEmailSentEvent;
use Smartheads\Application\UserMessage\Factory\UserMessageFactory;
use Smartheads\Domain\Interface\UserMessageRepositoryInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: ContactEmailSentEvent::class, method: 'saveEmail')]
readonly class ContactEmailSentListener
{
    public function __construct(
        private UserMessageRepositoryInterface $repository,
        private UserMessageFactory $userMessageFactory,
    ) {
    }

    public function saveEmail(ContactEmailSentEvent $event): void
    {
        $userMessage = $this->userMessageFactory->create($event);

        $this->repository->save($userMessage);
    }
}
