<?php

declare(strict_types=1);

namespace Smartheads\UI\Form\UserMessage;

use Smartheads\Application\UserMessage\DTO\UserMessageDTO;
use Smartheads\UI\Form\Validator\NationalIdentificationNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserMessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(max: 50),
                ],
            ])
            ->add('nationalIdentificationNumber', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new NationalIdentificationNumber(),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new Length(max: 1000),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserMessageDTO::class,
            'method' => 'POST',
            'translation_domain' => 'ui',
            'label_format' => 'user_message.form.%name%',
        ]);
    }
}
