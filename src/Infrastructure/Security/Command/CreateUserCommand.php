<?php

declare(strict_types=1);

namespace Smartheads\Infrastructure\Security\Command;

use Smartheads\Infrastructure\Security\DTO\UserDTO;
use Smartheads\Infrastructure\Security\User\Factory\UserFactory;
use Smartheads\Infrastructure\Security\User\UserRepository;
use Smartheads\Infrastructure\Security\Validator\CheckEmailExists;
use Smartheads\Infrastructure\Security\Validator\CheckPassword;
use Smartheads\Infrastructure\Security\Validator\EmailValidator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: self::NAME, description: 'Create a user')]
class CreateUserCommand extends Command
{
    const NAME = 'app:create-user';

    public function __construct(
        private readonly UserFactory $userFactory,
        private readonly CheckEmailExists $checkEmailExists,
        private readonly UserRepository $userRepository,
    ) {
        parent::__construct();
    }

    public function configure(): void
    {
        $this
            ->addArgument(
                name: 'email',
                mode: InputArgument::REQUIRED,
            )
            ->addArgument(
                name: 'password',
                mode: InputArgument::REQUIRED,
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        try {
            $this->checkEmailExists->execute($email);
        } catch (\InvalidArgumentException $e) {
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }

        CheckPassword::validate($password);
        EmailValidator::validate($email);

        $dto = new UserDTO(
            email: $email,
            password: $password
        );

        $user = $this->userFactory->create($dto);

        $this->userRepository->save($user);

        return Command::SUCCESS;
    }
}
