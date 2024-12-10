<?php

declare(strict_types=1);

namespace Smartheads\Infrastructure\Security\Validator;

use Smartheads\Infrastructure\Security\User\UserRepository;

class CheckEmailExists
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function execute(string $email): void
    {
        $count = $this->repository->getCountByEmail($email);

        if ($count >= 1) {
            throw new \InvalidArgumentException('security.user.validator.email_exists');
        }
    }
}
