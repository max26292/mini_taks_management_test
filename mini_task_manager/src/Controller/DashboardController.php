<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(UserRepository $repository,Request $request): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $tasks = collect($user->getTasks()->toArray())->groupBy(function (Task $task){
            return $task->getStatus();
        });
        return $this->render('dashboard/index.html.twig', [
            //'tasks' => $tasks
        ]);
    }
}
