<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\TaskNewTaskForm;
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
    #[Route('/new',name:'store')]
    public function store(Request $request,TaskRepository $repository)
    {
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(TaskNewTaskForm::class, null, [
            'action' => $this->generateUrl('tasks.store'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $repository->create($user,$form->getData());
            //dd($request->getPreferredFormat());
            //$request->setRequestFormat(TurboBundle::STREAM_FORMAT);
            //return;
            return $this->redirectToRoute('app_dashboard');
            // save...

            // do something
        }
        return $this->render('task/new.html.twig', [
            'form' => $form,
        ]);
    }
}
