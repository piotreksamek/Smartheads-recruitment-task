<?php

declare(strict_types=1);

namespace Smartheads\Domain\Entity\UserMessage;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use DateTimeImmutable;

#[Entity]
#[Table(name: 'user_message')]
class UserMessage
{
    #[Id]
    #[Column(type: UuidType::NAME, unique: true)]
    public Uuid $id;

    #[Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $sentAt = null;

    public function __construct(
        #[Embedded(Name::class)]
        private Name $name,
        #[Embedded(NationalIdentificationNumber::class)]
        private NationalIdentificationNumber $nationalIdentificationNumber,
        #[Embedded(Email::class)]
        private Email $email,
        #[Column(type: Types::BOOLEAN)]
        private bool $isSent,
        #[Embedded(Message::class)]
        private ?Message $message = null,
    ) {
        $this->id = Uuid::v7();

        if ($isSent) {
            $this->sentAt = new \DateTimeImmutable();
        }
    }
}
