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
        return $this->render('training_execution/index.html.twig', [
            'training_executions' => $trainingExecutionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_training_execution_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trainingExecution = new TrainingExecution();
        $form = $this->createForm(TrainingExecutionType::class, $trainingExecution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trainingExecution);
            $entityManager->flush();

            return $this->redirectToRoute('app_training_execution_index', [], Response::HTTP_SEE_OTHER);
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

            return $this->redirectToRoute('app_training_execution_index', [], Response::HTTP_SEE_OTHER);
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
}
