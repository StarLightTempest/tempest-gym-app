<?php

namespace App\DataFixtures;

use App\Entity\Person;
use App\Entity\TrainingPlan;
use App\Entity\WeightHistory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $person1 = new Person();
        $person1->setName('John Doe');
        $person1->setHeight(180);
        $manager->persist($person1);

        $person2 = new Person();
        $person2->setName('Jane Smith');
        $person2->setHeight(165);
        $manager->persist($person2);

        $person3 = new Person();
        $person3->setName('Robert Johnson');
        $person3->setHeight(175);
        $manager->persist($person3);

        $person4 = new Person();
        $person4->setName('Emily Davis');
        $person4->setHeight(170);
        $manager->persist($person4);
        


        $manager->flush();
    }
}
