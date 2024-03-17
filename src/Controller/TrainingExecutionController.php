<?php

namespace App\Controller;

use App\Entity\TrainingExecution;
use App\Form\TrainingExecutionType;
use App\Repository\TrainingExecutionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/training-execution')]
class TrainingExecutionController extends AbstractController
{
    #[Route('/', name: 'app_training_execution_index', methods: ['GET'])]
    public function index(TrainingExecutionRepository $trainingExecutionRepository): Response
    {
        // Fetch all training executions
        $allTrainingExecutions = $trainingExecutionRepository->findAll();

        return $this->render('training_execution/index.html.twig', [
            'training_executions' => $allTrainingExecutions,
        ]);
    }

    #[Route('/new', name: 'app_training_execution_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trainingExecution = new TrainingExecution();
        $form = $this->createForm(TrainingExecutionType::class, $trainingExecution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistAndFlush($entityManager, $trainingExecution);

            return $this->redirectToTrainingPlanOrIndex($trainingExecution);
        }

        return $this->render('training_execution/new.html.twig', [
            'training_execution' => $trainingExecution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_execution_show', methods: ['GET'])]
    public function show(TrainingExecution $trainingExecution): Response
    {
        return $this->render('training_execution/show.html.twig', [
            'training_execution' => $trainingExecution,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_training_execution_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TrainingExecution $trainingExecution, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrainingExecutionType::class, $trainingExecution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToTrainingPlanOrIndex($trainingExecution);
        }

        return $this->render('training_execution/edit.html.twig', [
            'training_execution' => $trainingExecution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_execution_delete', methods: ['POST'])]
    public function delete(Request $request, TrainingExecution $trainingExecution, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trainingExecution->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trainingExecution);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_training_execution_index', [], Response::HTTP_SEE_OTHER);
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
     * Redirect to the training plan show page if possible, otherwise redirect to the training execution index page.
     */
    private function redirectToTrainingPlanOrIndex(TrainingExecution $trainingExecution): Response
    {
        $trainingPlanXMachine = $trainingExecution->getTrainingPlanXMachineId();
        if ($trainingPlanXMachine) {
            $trainingPlan = $trainingPlanXMachine->getTrainingPlanId();
            if ($trainingPlan) {
                return $this->redirectToRoute('app_training_plan_show', ['id' => $trainingPlan->getId()]);
            }
        }

        return $this->redirectToRoute('app_training_execution_index');
    }
}