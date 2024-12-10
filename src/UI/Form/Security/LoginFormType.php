<?php

declare(strict_types=1);

namespace Smartheads\UI\Form\Security;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('_email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ]
            ])
            ->add('_password', PasswordType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
        ;
    }
}
