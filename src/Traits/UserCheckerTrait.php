<?php

namespace App\Traits;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

trait UserCheckerTrait
{
    public function checkLoggedUser($user): void
    {
        if ($user !== $this->getUser()) {
            throw new AccessDeniedException('This is not your profile!');
        }
    }
}