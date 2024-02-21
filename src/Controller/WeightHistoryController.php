<?php

namespace App\Controller;

use App\Entity\WeightHistory;
use App\Form\WeightHistoryType;
use App\Repository\WeightHistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/weight-history')]
class WeightHistoryController extends AbstractController
{
    #[Route('/', name: 'app_weight_history_index', methods: ['GET'])]
    public function index(WeightHistoryRepository $weightHistoryRepository): Response
    {
        return $this->render('weight_history/index.html.twig', [
            'weight_histories' => $weightHistoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_weight_history_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $weightHistory = new WeightHistory();
        $form = $this->createForm(WeightHistoryType::class, $weightHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($weightHistory);
            $entityManager->flush();

            return $this->redirectToRoute('app_weight_history_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('weight_history/new.html.twig', [
            'weight_history' => $weightHistory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weight_history_show', methods: ['GET'])]
    public function show(WeightHistory $weightHistory): Response
    {
        return $this->render('weight_history/show.html.twig', [
            'weight_history' => $weightHistory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_weight_history_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WeightHistory $weightHistory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WeightHistoryType::class, $weightHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_weight_history_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('weight_history/edit.html.twig', [
            'weight_history' => $weightHistory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weight_history_delete', methods: ['POST'])]
    public function delete(Request $request, WeightHistory $weightHistory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weightHistory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($weightHistory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_weight_history_index', [], Response::HTTP_SEE_OTHER);
    }
}
