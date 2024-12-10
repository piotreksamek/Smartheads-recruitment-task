<?php

declare(strict_types=1);

namespace Smartheads\Domain\Interface;

use Smartheads\Domain\Entity\UserMessage\UserMessage;

interface UserMessageRepositoryInterface
{
    public function save(UserMessage $userMessage): void;

    public function findAllUserMessages(): array;
}
