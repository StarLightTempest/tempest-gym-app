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
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/weight-history')]
class WeightHistoryController extends AbstractController
{
    #[Route('/', name: 'app_weight_history_index', methods: ['GET'])]
    public function index(WeightHistoryRepository $weightHistoryRepository): Response
    {
        // Fetch the weight histories for the current user
        $currentUserWeightHistories = $weightHistoryRepository->findBy(['user_id' => $this->getUser()]);

        return $this->render('weight_history/index.html.twig', [
            'weight_histories' => $currentUserWeightHistories,
        ]);
    }

    #[Route('/new', name: 'app_weight_history_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $weightHistory = new WeightHistory();
        $weightHistory->setUserId($this->getUser());

        $form = $this->createForm(WeightHistoryType::class, $weightHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistAndFlush($entityManager, $weightHistory);

            return $this->redirectToRoute('app_user_show', ['id' => $weightHistory->getUserId()->getId()]);
        }

        return $this->render('weight_history/new.html.twig', [
            'weight_history' => $weightHistory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weight_history_show', methods: ['GET'])]
    public function show(WeightHistory $weightHistory): Response
    {
        $this->denyAccessUnlessOwnedByCurrentUser($weightHistory);

        return $this->render('weight_history/show.html.twig', [
            'weight_history' => $weightHistory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_weight_history_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WeightHistory $weightHistory, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessOwnedByCurrentUser($weightHistory);

        $form = $this->createForm(WeightHistoryType::class, $weightHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_show', ['id' => $weightHistory->getUserId()->getId()]);
        }

        return $this->render('weight_history/edit.html.twig', [
            'weight_history' => $weightHistory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weight_history_delete', methods: ['POST'])]
    public function delete(Request $request, WeightHistory $weightHistory, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessOwnedByCurrentUser($weightHistory);

        if ($this->isCsrfTokenValid('delete'.$weightHistory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($weightHistory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_show', ['id' => $weightHistory->getUserId()->getId()]);
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
     * Deny access unless the weight history is owned by the current user.
     */
    private function denyAccessUnlessOwnedByCurrentUser(WeightHistory $weightHistory): void
    {
        if ($weightHistory->getUserId() !== $this->getUser()) {
            throw new AccessDeniedException('This is not your weight history!');
        }
    }
}