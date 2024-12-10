<?php

declare(strict_types=1);

namespace Smartheads\Domain\Entity\UserMessage;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;

#[Embeddable]
class Message
{
    public function __construct(
        #[Column(type: Types::TEXT, nullable: true)]
        private ?string $message = null,
    ) {
        self::isValid($this->message);
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public static function isValid(string $message): void
    {
        if (strlen($message) > 1000) {
            throw new InvalidArgumentException('Message name should not exceed 1000 characters.');
        }
    }
}
