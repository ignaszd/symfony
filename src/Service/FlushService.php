<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\UserRoles;

class FlushService
{
    private $doctrine;
    public function __construct(DoctrineService $doctrineService)
    {
        $this->doctrine = $doctrineService->doctrine;
    }

    private function flushEntity($entity)
    {
        $em = $this->doctrine->getManager();
        $em->persist($entity);
        $em->flush();
    }

    public function flushUser(User $user): void
    {
        $this->flushEntity($user);
    }

    public function flushUserRole(string $role): void
    {
        $userRole = new UserRoles();
        $userRole->setName($role);
        $this->flushEntity($userRole);
    }
}