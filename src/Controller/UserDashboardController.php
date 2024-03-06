<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\TrainingPlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserDashboardController extends AbstractController
{
    #[Route('/user-dashboard', name: 'app_user_dashboard')]

    public function index(UserRepository $userRepository, TrainingPlanRepository $trainingPlanRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /**@var User $user */
        $user = $this->getUser();

        // Fetch only the training plans related to the authenticated user
        $trainingPlans = $trainingPlanRepository->findBy(['user_id' => $user]);

        return match($user->isVerified()){
            true => $this->render('user_dashboard/index.html.twig', [
                'user' => $user,
                'trainingPlans' => $trainingPlans,
            ]),
            false => $this->render('user_dashboard/verify.html.twig'),
        };
    }
    
}