<?php

namespace App\Controller;

use App\Entity\TrainingPlan;
use App\Form\TrainingPlanType;
use App\Repository\TrainingPlanRepository;
use App\Traits\UserCheckerTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/training-plan')]
class TrainingPlanController extends AbstractController
{
    use UserCheckerTrait;
    #[Route('/', name: 'app_training_plan_index', methods: ['GET'])]
    public function index(TrainingPlanRepository $trainingPlanRepository): Response
    {
        // Fetch all training plans for the current user
        $userTrainingPlans = $trainingPlanRepository->findBy(['user_id' => $this->getUser()]);

        return $this->render('training_plan/index.html.twig', [
            'training_plans' => $userTrainingPlans,
        ]);
    }

    #[Route('/new', name: 'app_training_plan_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trainingPlan = new TrainingPlan();
        $trainingPlan->setUserId($this->getUser());

        $form = $this->createForm(TrainingPlanType::class, $trainingPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistAndFlush($entityManager, $trainingPlan);

            return $this->redirectToRoute('app_user_show', ['id' => $trainingPlan->getUserId()->getId()]);
        }

        return $this->render('training_plan/new.html.twig', [
            'training_plan' => $trainingPlan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_plan_show', methods: ['GET'])]
    public function show(TrainingPlan $trainingPlan, ?int $userId = null): Response
    {
        try {
            $this->denyAccessUnlessOwnedByCurrentUser($trainingPlan);
        } catch (AccessDeniedException $e) {
            $this->addFlash('error', 'Your not authoreized to see at this training Plan!');


            return $this->redirectToRoute('app_training_plan_index');
        }

        // Fetch the related TrainingPlanXMachines, Machines, and TrainingExecutions
        $relatedTrainingPlanXMachines = $trainingPlan->getTrainingPlanXMachines();

        return $this->render('training_plan/show.html.twig', [
            'training_plan' => $trainingPlan,
            'trainingPlanXMachines' => $relatedTrainingPlanXMachines,
            'user_id' => $userId,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_training_plan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TrainingPlan $trainingPlan, EntityManagerInterface $entityManager): Response
    {
        try {
            $this->denyAccessUnlessOwnedByCurrentUser($trainingPlan);
        } catch (AccessDeniedException $e) {
            $this->addFlash('error', 'This is not your training plan!');
            dd('wilhelm');

            return $this->redirectToRoute('app_training_plan_index');
        }

        $form = $this->createForm(TrainingPlanType::class, $trainingPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_show', ['id' => $trainingPlan->getUserId()->getId()]);
        }

        return $this->render('training_plan/edit.html.twig', [
            'training_plan' => $trainingPlan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_plan_delete', methods: ['POST'])]
    public function delete(Request $request, TrainingPlan $trainingPlan, EntityManagerInterface $entityManager): Response
    {
        try {
            $this->denyAccessUnlessOwnedByCurrentUser($trainingPlan);
        } catch (AccessDeniedException $e) {
            $this->addFlash('error', 'This is not your training plan!');

            return $this->redirectToRoute('app_training_plan_index');
        }

        if ($this->isCsrfTokenValid('delete'.$trainingPlan->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trainingPlan);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_show', ['id' => $trainingPlan->getUserId()->getId()]);
        }

        return $this->redirectToRoute('app_training_plan_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Persist and flush an entity.
     */
    private function persistAndFlush(EntityManagerInterface $entityManager, $entity): void
    {
        $entityManager->persist($entity);
        $entityManager->flush();
    }

    /**
     * Deny access unless the training plan is owned by the current user.
     */
    private function denyAccessUnlessOwnedByCurrentUser(TrainingPlan $trainingPlan): void
    {
        $this->checkLoggedUser($trainingPlan->getUserId());
    }
}