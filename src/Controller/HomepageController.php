<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use App\Repository\MachinesRepository;
use App\Repository\TrainingPlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomepageController extends AbstractController
{
    #[Route('/homepage', name: 'app_homepage')]
    #[Route('/', name: 'app_root')]
    public function index(PersonRepository $personRepository, MachinesRepository $machineRepository, TrainingPlanRepository $trainingPlanRepository): Response
    {
        $persons = $personRepository->findAll();
        $machines = $machineRepository->findAll();
        $trainingPlans = $trainingPlanRepository->findAll();

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'persons' => $persons,
            'machines' => $machines,
            'trainingPlans' => $trainingPlans,
        ]);
    }
}