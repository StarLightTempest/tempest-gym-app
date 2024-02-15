<?php

namespace App\DataFixtures;

use App\Entity\Machines;
use App\Entity\TrainingPlanXMachine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MachinesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $benchPress = new Machines();
        $benchPress->setName('Bench press');
        $benchPress->setMaxCapacity(100);
        $benchPress->setWeightIncrement(5);
        $manager->persist($benchPress);

        $squatRack = new Machines();
        $squatRack->setName('Squat rack');
        $squatRack->setMaxCapacity(200);
        $squatRack->setWeightIncrement(10);
        $manager->persist($squatRack);

        $legPress = new Machines();
        $legPress->setName('Leg press');
        $legPress->setMaxCapacity(300);
        $legPress->setWeightIncrement(15);
        $manager->persist($legPress);

        $manager->flush();
    }
}
