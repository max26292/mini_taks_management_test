<?php

namespace App\DataFixtures;

use App\DataFixtures\Seeder\UserSeeder;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private KernelInterface $kernel;

    public function __construct(
        KernelInterface $kernel,
        protected  UserSeeder $userSeeder
    )
    {
        $this->kernel = $kernel;
    }
    public function load(ObjectManager $manager): void
    {
        $env = $this->kernel->getEnvironment();
        // only seed data in dev environment
        if($env == 'dev'){
            $this->userSeeder->seed($manager,5);
        }
    }
}
