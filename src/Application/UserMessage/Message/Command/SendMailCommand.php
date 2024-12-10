<?php

declare(strict_types=1);

namespace Smartheads\Application\UserMessage\Message\Command;

readonly class SendMailCommand
{
    public function __construct(
        public string $name,
        public string $nationalIdentificationNumber,
        public string $email,
        public ?string $message = null,
    ) {
    }
}
