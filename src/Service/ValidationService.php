<?php

namespace App\Service;

use App\Entity\Employee;
use App\Entity\User;
use App\Entity\UserRoles;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ValidationService
{
    private $doctrine;

    public function __construct(DoctrineService $doctrineService)
    {
        $this->doctrine = $doctrineService->doctrine;
    }

    public function checkIfEmployeeExists(Form $form): bool
    {
        $email = $form->getData()->getEmail();
        $user = $this->doctrine->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);
        return isset($user) ? true : false;
    }

    public function checkIfRoleExist(string $newRole): bool
    {
        $role = $this->doctrine->getRepository(UserRoles::class)->findOneBy([
            'name' => $newRole
        ]);

        return isset($role) ? true : false;
    }

}