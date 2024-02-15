<?php

namespace App\DataFixtures;

use App\Entity\TrainingPlanXMachine;
use App\Entity\TrainingPlan;
use App\Entity\Machines;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrainingPlanXMachineFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $trainingPlan = $manager->getRepository(TrainingPlan::class)->find(1); // Replace 1 with the actual ID
        $legPress = $manager->getRepository(Machines::class)->find(1); // Replace 1 with the actual ID
        $benchPress = $manager->getRepository(Machines::class)->find(1);

        $trainingPlanXMachine1 = new TrainingPlanXMachine();
        $trainingPlanXMachine1->setWeight(100);
        $trainingPlanXMachine1->setIntervals(30);
        $trainingPlanXMachine1->setRepetitions(10);
        $trainingPlanXMachine1->setTrainingPlanId($trainingPlan);
        $trainingPlanXMachine1->setMachineId($legPress);
        $manager->persist($trainingPlanXMachine1);

        $trainingPlanXMachine2 = new TrainingPlanXMachine();
        $trainingPlanXMachine2->setWeight(150);
        $trainingPlanXMachine2->setIntervals(45);
        $trainingPlanXMachine2->setRepetitions(12);
        $trainingPlanXMachine2->setTrainingPlanId($trainingPlan);
        $trainingPlanXMachine2->setMachineId($benchPress);
        $manager->persist($trainingPlanXMachine2);

        $manager->flush();
    }
}
