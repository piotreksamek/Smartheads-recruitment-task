<?php

declare(strict_types=1);

namespace Smartheads\Domain\Entity\UserMessage;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use InvalidArgumentException;

#[Embeddable]
class Name
{
    public function __construct(
        #[Column(type: Types::STRING, length: 50)]
        private string $name
    ) {
        self::isValid($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function isValid(string $name): void
    {
        if (empty(trim($name))) {
            throw new InvalidArgumentException('Name cannot be empty or only whitespace.');
        }

        if (strlen($name) > 50) {
            throw new InvalidArgumentException('Name cannot exceed 50 characters.');
        }
    }
}