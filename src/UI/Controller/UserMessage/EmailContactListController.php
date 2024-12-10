<?php

declare(strict_types=1);

namespace Smartheads\UI\Controller\UserMessage;

use Smartheads\Application\UserMessage\Message\Query\GetUserMessagesQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class EmailContactListController extends AbstractController
{
    #[Route('/contact/list', name: 'ui_contact_list', methods: ['GET'])]
    public function __invoke(MessageBusInterface $queryBus): Response
    {
        $envelope = $queryBus->dispatch(new GetUserMessagesQuery());

        $handled = $envelope->last(HandledStamp::class);
        $userMessages = $handled->getResult();

        return $this->render('user_message/list.html.twig', [
            'userMessages' => $userMessages,
        ]);
    }
}
