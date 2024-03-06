<?php

namespace App\DataFixtures;

use App\Entity\WeightHistory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WeightHistoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = $manager->getRepository(User::class)->find(1);
        $user2 = $manager->getRepository(User::class)->find(1);  // Replace 1 with the actual ID

        $weightHistory1 = new WeightHistory();
        $weightHistory1->setDate(new \DateTime('2022-01-01'));
        $weightHistory1->setWeight(70);
        $weightHistory1->setUserId($user1);
        $manager->persist($weightHistory1);

        $weightHistory2 = new WeightHistory();
        $weightHistory2->setDate(new \DateTime('2022-02-01'));
        $weightHistory2->setWeight(72);
        $weightHistory2->setUserId($user2);
        $manager->persist($weightHistory2);

       

        $manager->flush();
    }
}