<?php

namespace App\Twig;

use Illuminate\Support\Collection;
use Twig\Extension\RuntimeExtensionInterface;

class TaskFilter implements RuntimeExtensionInterface
{
    public function getTasksByStatus(Collection $tasks, string $status)
    {
        return $tasks->get($status);
    }
}