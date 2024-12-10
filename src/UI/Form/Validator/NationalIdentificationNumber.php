<?php

declare(strict_types=1);

namespace Smartheads\UI\Form\Validator;

use Symfony\Component\Validator\Constraint;

class NationalIdentificationNumber extends Constraint
{
    public $message = 'Niepoprawny numer pesel';
}
