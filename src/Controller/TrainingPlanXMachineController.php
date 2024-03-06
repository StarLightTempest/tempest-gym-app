<?php

namespace App\Controller;

use App\Entity\TrainingPlanXMachine;
use App\Form\TrainingPlanXMachineType;
use App\Repository\TrainingPlanXMachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/training-plan-x-machine')]
class TrainingPlanXMachineController extends AbstractController
{
    #[Route('/', name: 'app_training_plan_x_machine_index', methods: ['GET'])]
    public function index(TrainingPlanXMachineRepository $trainingPlanXMachineRepository): Response
    {
        return $this->render('training_plan_x_machine/index.html.twig', [
            'training_plan_x_machines' => $trainingPlanXMachineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_training_plan_x_machine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trainingPlanXMachine = new TrainingPlanXMachine();
        $form = $this->createForm(TrainingPlanXMachineType::class, $trainingPlanXMachine, [
            'user' => $this->getUser(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trainingPlanXMachine);
            $entityManager->flush();

            return $this->redirectToRoute('app_training_plan_show', ['id' => $trainingPlanXMachine->getTrainingPlanId()->getId()]);
        }

        return $this->render('training_plan_x_machine/new.html.twig', [
            'training_plan_x_machine' => $trainingPlanXMachine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_plan_x_machine_show', methods: ['GET'])]
    public function show(TrainingPlanXMachine $trainingPlanXMachine): Response
    {
        return $this->render('training_plan_x_machine/show.html.twig', [
            'training_plan_x_machine' => $trainingPlanXMachine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_training_plan_x_machine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TrainingPlanXMachine $trainingPlanXMachine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrainingPlanXMachineType::class, $trainingPlanXMachine, [
            'user' => $this->getUser(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_training_plan_show', ['id' => $trainingPlanXMachine->getTrainingPlanId()->getId()]);
        }

        return $this->render('training_plan_x_machine/edit.html.twig', [
            'training_plan_x_machine' => $trainingPlanXMachine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_training_plan_x_machine_delete', methods: ['POST'])]
    public function delete(Request $request, TrainingPlanXMachine $trainingPlanXMachine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trainingPlanXMachine->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trainingPlanXMachine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_training_plan_x_machine_index', [], Response::HTTP_SEE_OTHER);
    }
}