<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AuthLoginForm;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class AuthController extends AbstractController
{
    #[Route('/login', name: 'auth_login')]
    public function login(UserRepository $repository, UserPasswordHasherInterface $passwordHasher, Security $security, Request $request): Response
    {
        $form = $this->createForm(AuthLoginForm::class, null, [
            'action' => $this->generateUrl('auth_login'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $repository->findUserByEmail($form->getData()['email']);
            if(!$user){
                /**
                 * have to render error message
                 */
                throw new \Exception('User not found');
            }
            if(!$passwordHasher->isPasswordValid($user, $form->getData()['password'])){
                /**
                 * have to render error message
                 */
                throw new \Exception('Invalid password');
            }
            $security->login($user);
            return $this->redirectToRoute('app_dashboard');
        }
        return $this->render('auth/index.html.twig', [
            'form' => $form,
        ]);
    }
}
