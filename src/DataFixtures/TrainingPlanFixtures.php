<?php

namespace App\DataFixtures;

use App\Entity\TrainingPlan;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrainingPlanFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = $manager->getRepository(User::class)->find(1); // Replace 1 with the actual ID
        $user2 = $manager->getRepository(User::class)->find(2); // Replace 2 with the actual ID

        $trainingPlan1 = new TrainingPlan();
        $trainingPlan1->setName('Plan 1');
        $trainingPlan1->setUserId($user1);
        $trainingPlan1->setDescription('Chest and Biceps');
        $trainingPlan1->setWeekday('Monday');
        $manager->persist($trainingPlan1);

        $manager->flush();
    }
}