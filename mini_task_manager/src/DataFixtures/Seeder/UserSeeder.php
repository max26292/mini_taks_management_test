<?php

namespace App\DataFixtures\Seeder;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Service\Attribute\Required;

class UserSeeder
{

    public function __construct(
        private readonly UserRepository              $userRepository,
        private readonly UserPasswordHasherInterface $userPasswordHasher,
        private readonly TaskSeeder                  $taskSeeder
    )
    {
    }

    public function seed(ObjectManager $manager, $amount): void
    {
        $defaultPassword = 'password';
        $hashedPassword = $this->userPasswordHasher->hashPassword(
            new User(),
            $defaultPassword
        );
        for ($i = 0; $i < $amount; $i++) {
            if ($this->userRepository->findUserByEmail('user' . $i . '@test.com')) {
                continue;
            }
            $user = new User();
            $user->setEmail('user' . $i . '@test.com');
            $user->setPassword($hashedPassword);
            $manager->persist($user);
            $manager->flush();
            $this->taskSeeder->seed($manager, 5, $user);
        }
    }
}
