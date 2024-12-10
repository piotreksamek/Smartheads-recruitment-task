<?php

declare(strict_types=1);

namespace Smartheads\Application\Mailer;

interface TemplateRendererInterface
{
    public function render(string $template, array $params): string;
}
