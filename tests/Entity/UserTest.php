<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\TrainingPlan;
use App\Entity\WeightHistory;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUser()
    {
        $user = new User();

        $user->setEmail('test@example.com');
        $this->assertEquals('test@example.com', $user->getEmail());

        $user->setRoles(['ROLE_ADMIN']);
        $this->assertContains('ROLE_ADMIN', $user->getRoles());

        $user->setPassword('password');
        $this->assertEquals('password', $user->getPassword());

        $user->setIsVerified(true);
        $this->assertEquals(true, $user->isVerified());

        $user->setName('Test User');
        $this->assertEquals('Test User', $user->getName());

        $user->setHeight('180');
        $this->assertEquals('180', $user->getHeight());

        $trainingPlan = new TrainingPlan();
        $user->addTrainingPlan($trainingPlan);
        $this->assertCount(1, $user->getTrainingPlans());

        $user->removeTrainingPlan($trainingPlan);
        $this->assertCount(0, $user->getTrainingPlans());

        $weightHistory = new WeightHistory();
        $user->addWeightHistory($weightHistory);
        $this->assertCount(1, $user->getWeightHistories());

        $user->removeWeightHistory($weightHistory);
        $this->assertCount(0, $user->getWeightHistories());
    }
}