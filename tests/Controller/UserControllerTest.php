<?php

namespace App\Tests\Controller;

use App\Controller\UserController;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserControllerTest extends TestCase
{
    private $authorizationChecker;
    private $formFactory;
    private $entityManager;

    protected function setUp(): void
    {
        // Create mocks for the AuthorizationCheckerInterface, FormFactoryInterface, and EntityManagerInterface
        $this->authorizationChecker = $this->createMock(AuthorizationCheckerInterface::class);
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
    }

    public function testNewUser()
    {
        // Create a User entity
        $user = new User();
        $user->setEmail('testuser@example.com');
        $user->setPassword('testpassword');
        $user->setIsVerified(true);

        // Create a Form mock
        $form = $this->createMock(FormInterface::class);
        $form->method('handleRequest')->willReturnSelf();
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);
        $form->method('getData')->willReturn($user);

        // Configure the FormFactoryInterface mock to return the Form mock
        $this->formFactory->method('create')->willReturn($form);

        // Configure the EntityManagerInterface mock to expect the persist and flush methods to be called
        $this->entityManager->expects($this->once())->method('persist')->with($this->equalTo($user));
        $this->entityManager->expects($this->once())->method('flush');

        // Create a UserController and call the new method
        $userController = new UserController($this->authorizationChecker);
        $request = new Request([], [], [], [], [], []);
        $response = $userController->new($request, $this->entityManager, $this->formFactory);

        // Assert that the response status code is 302 (Redirect)
        $this->assertEquals(302, $response->getStatusCode());
    }
}