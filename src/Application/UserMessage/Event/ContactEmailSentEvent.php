<?php

declare(strict_types=1);

namespace Smartheads\Application\UserMessage\Event;

readonly class ContactEmailSentEvent
{
    public function __construct(
        public string $name,
        public string $nationalIdentificationNumber,
        public string $email,
        public bool $isSent,
        public ?string $message = null,
    ) {
    }
}
