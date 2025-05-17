<?php

namespace App\EventListener;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class AuthenticateRequestListener
{
    private array $publicRoute = [
        'auth_login',
    ];
    private array $devRoute = [
        '_wdt',
        '_profiler',
    ];
    private string $homeRoute = 'app_dashboard';
    private string $loginRoute = 'auth_login';

    public function __construct(
        protected KernelInterface $kernel,
        protected readonly Security $security,
        protected UrlGeneratorInterface $urlGenerator)
    {
    }

    #[AsEventListener]
    public function onRequestEvent(RequestEvent $event): void
    {
        // ...
        if (!$event->isMainRequest()) {
            return;
        }
        $env = $this->kernel->getEnvironment();
        // only seed data in dev environment

        $request = $event->getRequest();
        $routeName = $request->attributes->get('_route');
        if($env == 'dev'){
            if(!in_array($routeName, $this->publicRoute)){
                return;
            }
        }
        if (in_array($routeName, $this->publicRoute) && $this->security->getUser()) {
            $event->setResponse(new RedirectResponse(
                $this->urlGenerator->generate($this->homeRoute)
            ));
        }
        // redirect for public user
        if(!$this->security->getUser()){
            // may need to enhance
            if(!in_array($routeName, $this->publicRoute)){
                $event->setResponse(new RedirectResponse(
                    $this->urlGenerator->generate($this->loginRoute)
                ));
            }
        }

    }
}
