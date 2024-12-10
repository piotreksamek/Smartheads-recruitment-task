<?php

declare(strict_types=1);

namespace Smartheads\Application\UserMessage\MessageHandler\Query;

use Smartheads\Application\UserMessage\DTO\UserMessageDTO;
use Smartheads\Application\UserMessage\Message\Query\GetUserMessagesQuery;
use Smartheads\Domain\Interface\UserMessageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetUserMessagesQueryHandler
{
    public function __construct(private readonly UserMessageRepositoryInterface $repository)
    {}

    public function __invoke(GetUserMessagesQuery $messages): array
    {
        $results = [];

        foreach ($this->repository->findAllUserMessages() as $userMessage) {
            $dto = new UserMessageDTO();

            $dto->name = $userMessage['name.name'];
            $dto->email = $userMessage['email.email'];
            $dto->nationalIdentificationNumber = $userMessage['nationalIdentificationNumber.nationalIdentificationNumber'];
            $dto->message = $userMessage['message.message'];
            $dto->isSent = $userMessage['isSent'];
            $dto->sentAt = $userMessage['sentAt'];

            $results[] = $dto;
        }

        return $results;
    }
}
