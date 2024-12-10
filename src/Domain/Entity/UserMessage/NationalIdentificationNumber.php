<?php

declare(strict_types=1);

namespace Smartheads\Domain\Entity\UserMessage;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use Smartheads\Domain\Exception\InvalidNationalIdentificationNumber;

#[Embeddable]
class NationalIdentificationNumber
{
    public function __construct(
        #[Column(type: Types::STRING, length: 11)]
        private string $nationalIdentificationNumber,
    ) {
        self::validate($nationalIdentificationNumber);
    }

    public function getNationalIdentificationNumber(): string
    {
        return $this->nationalIdentificationNumber;
    }

    public static function validate(string $nationalIdentificationNumber): void
    {
        if (!preg_match('/^[0-9]{11}$/', $nationalIdentificationNumber)) {
            throw new InvalidNationalIdentificationNumber();
        }

        $arrSteps = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $intSum = 0;

        for ($i = 0; $i < 10; $i++) {
            $intSum += $arrSteps[$i] * $nationalIdentificationNumber[$i];
        }

        $int = 10 - $intSum % 10;
        $intControlNr = ($int == 10) ? 0 : $int;

        if (!$intControlNr == $nationalIdentificationNumber[10]) {
            throw new InvalidNationalIdentificationNumber();
        }
    }
}
