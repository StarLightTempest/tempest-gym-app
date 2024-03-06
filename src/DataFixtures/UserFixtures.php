<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setName('John Doe');
        $user1->setHeight(180);
        $user1->setEmail('john@example.com');
        $user1->setPassword('test123');
        $user1->setIsVerified(1);
        $manager->persist($user1);

        $manager->flush();
    }
}
