<?php

namespace App\DataFixtures;

use App\Entity\WeightHistory;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WeightHistoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $person1 = $manager->getRepository(Person::class)->find(1);
        $person2 = $manager->getRepository(Person::class)->find(1);  // Replace 1 with the actual ID

        $weightHistory1 = new WeightHistory();
        $weightHistory1->setDate(new \DateTime('2022-01-01'));
        $weightHistory1->setWeight(70);
        $weightHistory1->setPersonId($person1);
        $manager->persist($weightHistory1);

        $weightHistory2 = new WeightHistory();
        $weightHistory2->setDate(new \DateTime('2022-02-01'));
        $weightHistory2->setWeight(72);
        $weightHistory2->setPersonId($person2);
        $manager->persist($weightHistory2);

       

        $manager->flush();
    }
}