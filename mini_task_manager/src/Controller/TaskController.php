<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Turbo\TurboBundle;

#[Route('/tasks', name: 'tasks.')]
final class TaskController extends AbstractController
{
    #[Route('/', name: 'list_tasks')]
    public function index(Request $request, TaskRepository $repository): Response
    {
        $taskType = $request->headers->get('Turbo-Frame');
        /** @var User $user */
        $user = $this->getUser();
        $tasks = $repository->getTasksByUser($user->getId(), $taskType);
        return $this->render('dashboard/components/task-column.html.twig', [
            'status' => $taskType,
            'tasks' => $tasks,
        ]);
    }
}
