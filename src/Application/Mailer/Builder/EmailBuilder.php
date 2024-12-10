<?php

declare(strict_types=1);

namespace Smartheads\Application\Mailer\Builder;

use Symfony\Component\Mime\Email;

class EmailBuilder
{
    private Email $email;

    public function __construct(
    ) {
        $this->email = new Email();
    }

    public static function create(): self
    {
        return new self();
    }

    public function from(string $from): self
    {
        $this->email
            ->from($from);

        return $this;
    }

    public function to(string $to): self
    {
        $this->email
            ->to($to);

        return $this;
    }

    public function withContent(string $subject, string $htmlContent): self
    {
        $this->email
            ->subject($subject)
            ->html($htmlContent);

        return $this;
    }

    public function build(): Email
    {
        return $this->email;
    }
}
