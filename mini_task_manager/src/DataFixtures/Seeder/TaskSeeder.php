<?php

namespace App\DataFixtures\Seeder;

use App\Constant\TaskStatus;
use App\Entity\Task;
use App\Entity\User;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Service\Attribute\Required;

class TaskSeeder
{

    public function __construct()
    {
    }

    #[NoReturn] public function seed(ObjectManager $manager, $amount, User $user): void
    {
        $status = TaskStatus::values();
        for ($i = 0; $i < $amount; $i++) {

            $randomStatus = $status[array_rand($status)];
            $task = new Task();
            $task->setTitle('Tasks ' . $i);
            $task->setStatus($randomStatus);
            $task->setUserId($user);
            $task->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($task);
            $manager->flush();
        }
    }
}
