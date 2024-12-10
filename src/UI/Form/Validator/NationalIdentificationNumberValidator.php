<?php

declare(strict_types=1);

namespace Smartheads\UI\Form\Validator;

use Smartheads\Domain\Entity\UserMessage\NationalIdentificationNumber as NationalIdentificationNumberVO;
use Smartheads\Domain\Exception\InvalidNationalIdentificationNumber;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NationalIdentificationNumberValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): bool
    {
        if (!$constraint instanceof NationalIdentificationNumber) {
            throw new UnexpectedTypeException($constraint, NationalIdentificationNumber::class);
        }

        if (null === $value || '' === $value) {
            return false;
        }

        try {
            NationalIdentificationNumberVO::validate($value);
        } catch (InvalidNationalIdentificationNumber $e) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();

            return false;
        }

        return true;
    }
}
