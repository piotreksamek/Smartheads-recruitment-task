<?php

declare(strict_types=1);

namespace Smartheads\Infrastructure\UserMessage;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Smartheads\Domain\Entity\UserMessage\UserMessage;
use Smartheads\Domain\Interface\UserMessageRepositoryInterface;

class UserMessageRepository extends ServiceEntityRepository implements UserMessageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMessage::class);
    }

    public function save(UserMessage $userMessage): void
    {
        $em = $this->getEntityManager();

        $em->persist($userMessage);
        $em->flush();
    }

    public function findAllUserMessages(): array
    {
        $qb = $this->createQueryBuilder('um');

        $qb
            ->select('
                um.name.name,
                um.email.email,
                um.nationalIdentificationNumber.nationalIdentificationNumber,
                um.message.message,
                um.sentAt,
                um.isSent
            ')
        ;

        return $qb->getQuery()->getArrayResult();
    }
}
