<?php

namespace App\DataFixtures;

use App\Entity\TrainingPlan;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrainingPlanFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $person1 = $manager->getRepository(Person::class)->find(1); // Replace 1 with the actual ID
        $person2 = $manager->getRepository(Person::class)->find(2); // Replace 2 with the actual ID

        $trainingPlan1 = new TrainingPlan();
        $trainingPlan1->setName('Plan 1');
        $trainingPlan1->setPersonId($person1);
        $trainingPlan1->setDescription('Chest and Biceps');
        $trainingPlan1->setWeekday('Monday');
        $manager->persist($trainingPlan1);

        $trainingPlan2 = new TrainingPlan();
        $trainingPlan2->setName('Plan 2');
        $trainingPlan2->setPersonId($person2);
        $trainingPlan1->setDescription('Back Legs');
        $trainingPlan1->setWeekday('Thursday');
        $manager->persist($trainingPlan2);

        $manager->flush();
    }
}