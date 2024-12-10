<?php

declare(strict_types=1);

namespace Smartheads\Application\UserMessage\MessageHandler\Command;

use Psr\Log\LoggerInterface;
use Smartheads\Application\Mailer\Builder\EmailBuilder;
use Smartheads\Application\Mailer\ContactMailerInterface;
use Smartheads\Application\Mailer\TemplateRendererInterface;
use Smartheads\Application\UserMessage\Event\ContactEmailSentEvent;
use Smartheads\Application\UserMessage\Message\Command\SendMailCommand;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class SendMailCommandHandler
{
    public const CONTACT_EMAIL_TITLE = 'New contact email';

    public function __construct(
        #[Autowire('%app.email_from%')]
        private string $from,
        #[Autowire('%app.email_to%')]
        private string $to,
        private EventDispatcherInterface $eventDispatcher,
        private ContactMailerInterface $contactMailer,
        private LoggerInterface $logger,
        private TemplateRendererInterface $templateRenderer,
    ) {
    }

    public function __invoke(SendMailCommand $message)
    {
        $template = $this->templateRenderer->render(
            '/mail/user_message_mail.html.twig',
            [
                'email' => $message->email,
                'message' => $message->message,
                'name' => $message->name,
                'nationalIdentificationNumber' => $message->nationalIdentificationNumber,
            ]
        );

        $email = EmailBuilder::create()
            ->from($this->from)
            ->to($this->to)
            ->withContent(self::CONTACT_EMAIL_TITLE, $template)
            ->build()
        ;

        try {
            $this->contactMailer->send($email);

            $isSent = true;
        } catch (TransportExceptionInterface $exception) {
            $this->logger->info($exception->getMessage());

            $isSent = false;
        }

        $event = new ContactEmailSentEvent(
            name: $message->name,
            nationalIdentificationNumber: $message->nationalIdentificationNumber,
            email: $message->email,
            isSent: $isSent,
            message: $message->message,
        );

        $this->eventDispatcher->dispatch($event);
    }
}
