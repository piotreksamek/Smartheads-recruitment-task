<?php

declare(strict_types=1);

namespace Smartheads\UI\Controller\UserMessage;

use Smartheads\Application\UserMessage\DTO\UserMessageDTO;
use Smartheads\Application\UserMessage\Message\Command\SendMailCommand;
use Smartheads\UI\Form\UserMessage\UserMessageFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class SendEmailContactController extends AbstractController
{
    #[Route('/contact', name: 'ui_contact', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, MessageBusInterface $bus)
    {
        $dto = new UserMessageDTO();

        $form = $this->createForm(UserMessageFormType::class, $dto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bus->dispatch(new SendMailCommand(
                name: $dto->name,
                nationalIdentificationNumber: $dto->nationalIdentificationNumber,
                email: $dto->email,
                message: $dto->message
            ));

            $this->addFlash('success', 'user_message.view.create.success');
        }

        return $this->render('user_message/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
