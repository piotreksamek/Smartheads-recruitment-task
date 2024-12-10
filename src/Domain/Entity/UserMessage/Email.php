<?php

declare(strict_types=1);

namespace Smartheads\Domain\Entity\UserMessage;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;

#[Embeddable]
class Email
{
    public function __construct(
        #[Column(type: Types::STRING)]
        private string $email,
    ) {
        if (!self::isValid($email)) {
            throw new InvalidArgumentException('Invalid email address.');
        }
    }

    public static function isValid(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
