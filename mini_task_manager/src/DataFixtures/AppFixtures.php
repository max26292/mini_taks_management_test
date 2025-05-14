<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel,private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->kernel = $kernel;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $env = $this->kernel->getEnvironment();
        // only seed data in dev environment
        if($env == 'dev'){
            $totalUser = 3;
            $defaultPassword = 'password';
            $hashedPassword = $this->userPasswordHasher->hashPassword(
                new User(),
                $defaultPassword
            );
            for($i = 0; $i < $totalUser; $i++){
                $user = new User();
                $user->setEmail('user'.$i.'@test.com');
                $user->setPassword($hashedPassword);
                $manager->persist($user);
            }
        }
        $manager->flush();
    }
}
