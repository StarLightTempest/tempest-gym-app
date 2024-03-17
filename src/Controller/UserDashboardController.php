<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\TrainingPlanRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserDashboardController extends AbstractController
{
    #[Route('/user-dashboard', name: 'app_user_dashboard')]
    public function index(UserRepository $userRepository, TrainingPlanRepository $trainingPlanRepository): Response
    {
        // Ensure the user is fully authenticated
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Fetch the currently authenticated user
        /**@var User $authenticatedUser */
        $authenticatedUser = $this->getUser();

        // Fetch only the training plans related to the authenticated user
        $userTrainingPlans = $trainingPlanRepository->findBy(['user_id' => $authenticatedUser]);

        // Render the appropriate view based on whether the user is verified
        return $this->renderAppropriateView($authenticatedUser, $userTrainingPlans);
    }

    /**
     * Render the appropriate view based on whether the user is verified.
     */
    private function renderAppropriateView(User $authenticatedUser, array $userTrainingPlans): Response
    {
        if ($authenticatedUser->isVerified()) {
            return $this->render('user_dashboard/index.html.twig', [
                'user' => $authenticatedUser,
                'trainingPlans' => $userTrainingPlans,
            ]);
        } else {
            return $this->render('user_dashboard/verify.html.twig');
        }
    }
}