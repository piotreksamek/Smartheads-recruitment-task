<?php

declare(strict_types=1);

namespace Smartheads\Application\UserMessage\DTO;

use DateTimeImmutable;

class UserMessageDTO
{
    public string $name;
    public string $nationalIdentificationNumber;
    public string $email;
    public bool $isSent;
    public ?string $message = null;
    public ?DateTimeImmutable $sentAt = null;
}
