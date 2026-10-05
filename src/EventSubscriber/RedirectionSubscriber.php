<?php

namespace App\EventSubscriber;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Intercepte chaque requête.
 *
 * Si la redirection est activée (ENABLE_REDIRECTION=true), toutes les requêtes
 * "principales" sont redirigées vers une page d'attente qui avertit l'utilisateur
 * qu'il doit désormais se connecter sur la nouvelle URL.
 */
class RedirectionSubscriber implements EventSubscriberInterface
{
    /** Nom de la route de la page d'attente (ne doit jamais être redirigée). */
    public const REDIRECT_ROUTE = 'app_redirect';

    /** Extensions de fichiers considérées comme des assets statiques (non interceptées). */
    private const ASSET_EXTENSIONS = [
        'js', 'css', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp',
        'woff', 'woff2', 'ttf', 'eot', 'map', 'json', 'txt', 'pdf', 'xlsx',
    ];

    /** Routes internes de Symfony/de debug à ne pas intercepter (évite les boucles/problèmes). */
    private const EXCLUDED_ROUTES = [
        'app_redirect',   // la page d'attente elle-même
        'app_export_excel', // export de fichier : on ne redirige pas
        '_wdt',
        '_profiler',
        '_profiler_search',
        '_profiler_search_bar',
        '_profiler_search_results',
        '_profiler_router',
        '_profiler_exception',
        '_profiler_exception_css',
        '_error',
    ];

    public function __construct(
        #[Autowire('%env(bool:ENABLE_REDIRECTION)%')]
        private readonly bool $redirectionEnabled,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 10],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        // Seules les requêtes principales (pas de sous-requêtes) sont interceptées
        if (!$event->isMainRequest()) {
            return;
        }

        if (!$this->redirectionEnabled) {
            return;
        }

        $request = $event->getRequest();

        // Ne pas rediriger la page d'attente elle-même (évite une boucle infinie)
        $route = $request->attributes->get('_route');
        if (\in_array($route, self::EXCLUDED_ROUTES, true)) {
            return;
        }

        // Ne pas rediriger les assets statiques
        $pathInfo = $request->getPathInfo();
        $extension = strtolower(pathinfo($pathInfo, PATHINFO_EXTENSION));
        if ($extension !== '' && \in_array($extension, self::ASSET_EXTENSIONS, true)) {
            return;
        }

        // Ne pas rediriger les requêtes AJAX / fragments (formulaires, Turbo Frame)
        if ($request->isXmlHttpRequest()) {
            return;
        }
        if ($request->headers->has('turbo-frame')) {
            return;
        }

        // Tout le reste est redirigé vers la page d'attente
        $event->setResponse(
            new RedirectResponse($this->urlGenerator->generate(self::REDIRECT_ROUTE))
        );
    }
}
