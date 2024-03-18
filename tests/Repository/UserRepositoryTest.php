<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    private $userRepository;
    private $entityManager;

    protected function setUp(): void
    {
        // Create a mock for the UserRepository
        $managerRegistry = $this->createMock(ManagerRegistry::class);
        $this->userRepository = new UserRepository($managerRegistry);
        // Create a mock for the EntityManager
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
    }

    public function testFindByUser()
    {
        // Create a User entity
        $user = new User();
        $user->setEmail('testuser@example.com');
        $user->setPassword('testpassword');

        // Configure the stub.
//        $this->userRepository->method('findByUser')
//            ->willReturn($user);

        // Use the findByUser method
        $foundUser = $this->userRepository->findByUser($user);

        // Assert that the found user is the same as the one we created
        $this->assertSame($user, $foundUser);
    }
    public function testUpgradePassword()
    {
        // Create a User entity
        $user = new User();
        $user->setEmail('testuser@example.com');
        $user->setPassword('oldpassword');

        // Configure the UserRepository mock to simulate the upgradePassword method
        $this->userRepository->method('upgradePassword')
            ->will($this->returnCallback(function($user, $newPassword) {
                $user->setPassword($newPassword);
            }));

        // Call the upgradePassword method
        $this->userRepository->upgradePassword($user, 'newhashedpassword');

        // Assert that the user's password was updated
        $this->assertEquals('newhashedpassword', $user->getPassword());
    }
}
