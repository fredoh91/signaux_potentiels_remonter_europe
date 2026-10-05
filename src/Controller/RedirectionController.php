<?php

namespace App\Controller;

use App\EventSubscriber\RedirectionSubscriber;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RedirectionController extends AbstractController
{
    #[Route('/redirection', name: RedirectionSubscriber::REDIRECT_ROUTE)]
    public function index(
        #[Autowire('%env(string:REDIRECTION_URL)%')] string $redirectionUrl,
        #[Autowire('%env(int:REDIRECTION_DELAY_SECONDS)%')] int $delaySeconds,
    ): Response {
        return $this->render('redirection/redirection.html.twig', [
            'redirectionUrl' => $redirectionUrl,
            'delaySeconds'   => $delaySeconds,
        ]);
    }
}
