<?php

declare(strict_types=1);

namespace Smartheads\Infrastructure\Security\DTO;

readonly class UserDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
