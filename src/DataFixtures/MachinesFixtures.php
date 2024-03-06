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
        $benchPress->setDescription('A weight training exercise that targets the chest muscles, but also works the shoulders and triceps.');
        $benchPress->setPictureURL('https://static.wixstatic.com/media/fd58de_64de9a2a76204a028f696f51d7e1a2c1~mv2.gif');
        $manager->persist($benchPress);

        $squatRack = new Machines();
        $squatRack->setName('Squat rack');
        $squatRack->setMaxCapacity(200);
        $squatRack->setWeightIncrement(10);
        $squatRack->setDescription('A piece of equipment used in weight training, specifically for the exercise known as squats.');
        $squatRack->setPictureURL('squat_rack.jpg');
        $manager->persist($squatRack);

        $legPress = new Machines();
        $legPress->setName('Leg press');
        $legPress->setMaxCapacity(300);
        $legPress->setWeightIncrement(15);
        $legPress->setDescription('A weight training exercise in which the individual pushes a weight or resistance away from them using their legs.');
        $legPress->setPictureURL('leg_press.jpg');
        $manager->persist($legPress);

        $treadmill = new Machines();
        $treadmill->setName('Treadmill');
        $treadmill->setMaxCapacity(150);
        $treadmill->setWeightIncrement(1);
        $treadmill->setDescription('A machine for running or walking while staying in one place.');
        $treadmill->setPictureURL('treadmill.jpg');
        $manager->persist($treadmill);

        $elliptical = new Machines();
        $elliptical->setName('Elliptical machine');
        $elliptical->setMaxCapacity(120);
        $elliptical->setWeightIncrement(1);
        $elliptical->setDescription('A stationary exercise machine used to simulate stair climbing, walking, or running without causing excessive pressure to the joints.');
        $elliptical->setPictureURL('elliptical.jpg');
        $manager->persist($elliptical);

        $rowing = new Machines();
        $rowing->setName('Rowing machine');
        $rowing->setMaxCapacity(200);
        $rowing->setWeightIncrement(5);
        $rowing->setDescription('A machine used to simulate the action of watercraft rowing for the purpose of exercise or training for rowing.');
        $rowing->setPictureURL('rowing.jpg');
        $manager->persist($rowing);

        $stationaryBike = new Machines();
        $stationaryBike->setName('Stationary bike');
        $stationaryBike->setMaxCapacity(120);
        $stationaryBike->setWeightIncrement(1);
        $stationaryBike->setDescription('A device used as exercise equipment. It includes a saddle, pedals, and some form of handlebars arranged as on a bicycle.');
        $stationaryBike->setPictureURL('stationary_bike.jpg');
        $manager->persist($stationaryBike);

        $stairMaster = new Machines();
        $stairMaster->setName('StairMaster');
        $stairMaster->setMaxCapacity(150);
        $stairMaster->setWeightIncrement(1);
        $stairMaster->setDescription('A machine that simulates the exercise of climbing stairs.');
        $stairMaster->setPictureURL('stairmaster.jpg');
        $manager->persist($stairMaster);

        $latPullDown = new Machines();
        $latPullDown->setName('Lat pull-down machine');
        $latPullDown->setMaxCapacity(100);
        $latPullDown->setWeightIncrement(5);
        $latPullDown->setDescription('A strength training exercise designed to develop the latissimus dorsi muscle and biceps.');
        $latPullDown->setPictureURL('lat_pull_down.jpg');
        $manager->persist($latPullDown);

        $cableCrossover = new Machines();
        $cableCrossover->setName('Cable crossover machine');
        $cableCrossover->setMaxCapacity(80);
        $cableCrossover->setWeightIncrement(2.5);
        $cableCrossover->setDescription('A type of cable machine used in weight lifting with pull-up bars and a stack of weights.');
        $cableCrossover->setPictureURL('cable_crossover.jpg');
        $manager->persist($cableCrossover);

        $legCurl = new Machines();
        $legCurl->setName('Leg curl machine');
        $legCurl->setMaxCapacity(80);
        $legCurl->setWeightIncrement(2.5);
        $legCurl->setDescription('A levered weight training machine for targeting the hamstring muscles.');
        $legCurl->setPictureURL('leg_curl.jpg');
        $manager->persist($legCurl);

        $pecDeck = new Machines();
        $pecDeck->setName('Pec deck machine');
        $pecDeck->setMaxCapacity(80);
        $pecDeck->setWeightIncrement(2.5);
        $pecDeck->setDescription('A machine designed to simulate the chest fly exercise.');
        $pecDeck->setPictureURL('pec_deck.jpg');
        $manager->persist($pecDeck);

        $smithMachine = new Machines();
        $smithMachine->setName('Smith machine');
        $smithMachine->setMaxCapacity(200);
        $smithMachine->setWeightIncrement(5);
        $smithMachine->setDescription('A weight machine used for weight training. It consists of a barbell that is fixed within steel rails, allowing only vertical movement.');
        $smithMachine->setPictureURL('smith_machine.jpg');
        $manager->persist($smithMachine);

        $manager->flush();
    }
}
