<?php

namespace App\DataFixtures;

use App\Entity\TrainingExecution;
use App\Entity\TrainingPlanXMachine;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrainingExecutionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $trainingPlanXMachine = $manager->getRepository(TrainingPlanXMachine::class)->find(1); // Assuming the ID is 1

        $trainingExecution1 = new TrainingExecution();
        $trainingExecution1->setDate(new DateTime('2022-01-01'));
        $trainingExecution1->setTrainingPlanXMachineId($trainingPlanXMachine);
        $trainingExecution1->setCompleted(true);
        $manager->persist($trainingExecution1);

        $trainingExecution2 = new TrainingExecution();
        $trainingExecution2->setDate(new DateTime('2022-01-02'));
        $trainingExecution2->setTrainingPlanXMachineId($trainingPlanXMachine);
        $trainingExecution2->setCompleted(false);
        $manager->persist($trainingExecution2);

        $manager->flush();
    }
}
