<?php

declare(strict_types=1);

namespace Smartheads\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/', name: 'ui_', methods: [Request::METHOD_GET])]
class HomeController extends AbstractController
{
    #[Route(name: 'home')]
    public function __invoke(): Response
    {
        return $this->render('base.html.twig');
    }
}
