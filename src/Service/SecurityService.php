<?php

namespace App\Service;

use Symfony\Bundle\SecurityBundle\Security;

class SecurityService
{
    // Avoid calling getUser() in the constructor: auth may not
    // be complete yet. Instead, store the entire Security object.
    public function __construct(
        private Security $security,
    ){
    }

    public function getUser()
    {
        $user = $this->security->getUser();

        return $user;
    }

    public function checkUserRole(string $role): bool
    {
        return $this->security->isGranted($role);
    }
}