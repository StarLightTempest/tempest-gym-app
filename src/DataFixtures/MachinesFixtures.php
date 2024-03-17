<?php

namespace App\DataFixtures;

use App\Entity\Machines;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MachinesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $machinesData = [
            ['Bench press', 100, 5, 'A weight training exercise that targets the chest muscles, but also works the shoulders and triceps.'],
            ['Squat rack', 200, 10, 'A piece of equipment used in weight training, specifically for the exercise known as squats.'],
            ['Leg press', 300, 15, 'A weight training exercise in which the individual pushes a weight or resistance away from them using their legs.'],
            ['Treadmill', 150, 1, 'A machine for running or walking while staying in one place.'],
            ['Elliptical machine', 120, 1, 'A stationary exercise machine used to simulate stair climbing, walking, or running without causing excessive pressure to the joints.'],
            ['Rowing machine', 200, 5, 'A machine used to simulate the action of watercraft rowing for the purpose of exercise or training for rowing.'],
            ['Stationary bike', 120, 1, 'A device used as exercise equipment. It includes a saddle, pedals, and some form of handlebars arranged as on a bicycle.'],
            ['StairMaster', 150, 1, 'A machine that simulates the exercise of climbing stairs.'],
            ['Lat pull-down machine', 100, 5, 'A strength training exercise designed to develop the latissimus dorsi muscle and biceps.'],
            ['Cable crossover machine', 80, 2.5, 'A type of cable machine used in weight lifting with pull-up bars and a stack of weights.'],
            ['Leg curl machine', 80, 2.5, 'A levered weight training machine for targeting the hamstring muscles.'],
            ['Pec deck machine', 80, 2.5, 'A machine designed to simulate the chest fly exercise.'],
            ['Smith machine', 200, 5, 'A weight machine used for weight training. It consists of a barbell that is fixed within steel rails, allowing only vertical movement.'],
        ];

        foreach ($machinesData as [$name, $maxCapacity, $weightIncrement, $description]) {
            $machine = new Machines();
            $machine->setName($name);
            $machine->setMaxCapacity($maxCapacity);
            $machine->setWeightIncrement($weightIncrement);
            $machine->setDescription($description);
            $manager->persist($machine);
        }

        $manager->flush();
    }
}