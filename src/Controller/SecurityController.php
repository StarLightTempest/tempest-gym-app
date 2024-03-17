<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // If the user is already logged in, redirect to the dashboard
        if ($loggedInUser = $this->getUser()) {
            return $this->redirectToRoute('app_user_dashboard');
        }

        // Get the login error if there is one
        $loginError = $authenticationUtils->getLastAuthenticationError();
        // Get the last username entered by the user
        $lastEnteredUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastEnteredUsername, 
            'error' => $loginError
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // This method can be blank - it will be intercepted by the logout key on your firewall.
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}