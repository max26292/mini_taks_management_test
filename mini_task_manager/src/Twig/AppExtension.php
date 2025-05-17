<?php

namespace App\Twig;

use Symfony\Bundle\SecurityBundle\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function __construct(private Security $security)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getUser', [$this, 'getUser']),
        ];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('getTasksByStatus', [TaskFilter::class, 'getTasksByStatus']),
        ];
    }

    public function getUser()
    {

        $user = $this->security->getUser();
        if ($user) {
            return [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
            ];
        }
        return null;
    }
}