<?php

declare(strict_types=1);

namespace Smartheads\Infrastructure\Security\User\Factory;

use Smartheads\Domain\Entity\Security\User;
use Smartheads\Infrastructure\Security\DTO\UserDTO;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher,
    ) {
    }

    public function create(UserDTO $dto): User
    {
        $user = new User(
            email: $dto->email,
            roles: ['ROLE_USER'],
        );

        $user->setPassword($this->userPasswordHasher->hashPassword($user, $dto->password));

        return $user;
    }
}
