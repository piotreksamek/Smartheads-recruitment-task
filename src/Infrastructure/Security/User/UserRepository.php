<?php

declare(strict_types=1);

namespace Smartheads\Infrastructure\Security\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Smartheads\Domain\Entity\Security\User;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $user): void
    {
        $em = $this->getEntityManager();

        $em->persist($user);
        $em->flush();
    }

    public function getCountByEmail(string $email): int
    {
        $qb = $this->createQueryBuilder('u');

        $qb
            ->select('COUNT(u.id)')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}
