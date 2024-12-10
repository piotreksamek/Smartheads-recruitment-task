<?php

declare(strict_types=1);

namespace Smartheads\Infrastructure\Security\Validator;

use InvalidArgumentException;

class CheckPassword
{
    public static function validate(string $password)
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters long');
        }
    }
}
