<?php

declare(strict_types=1);

namespace Smartheads\Infrastructure\Security\Validator;

use InvalidArgumentException;

class EmailValidator
{
    public static function validate(string $email): void
    {
        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;

        if (!$isValid) {
            throw new InvalidArgumentException('Invalid email');
        }
    }
}
