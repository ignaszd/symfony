<?php

namespace App\Controller;

use App\Service\FlushService;
use App\Service\SecurityService;
use App\Service\ValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends AbstractController
{
    private $validationService;
    private $flushService;
    public function __construct(
        ValidationService $validationService,
        FlushService $flushService,
    )
    {
        $this->validationService = $validationService;
        $this->flushService = $flushService;
    }

    #[Route('/role/create', name: 'role_create', methods: ["POST"])]
    public function createRole(Request $request)
    {
        $role = $request->request->get('new_role');
        if($this->validationService->checkIfRoleExist($role))
            dd('Role already exist');
        $this->flushService->flushUserRole($role);
        return $this->redirectToRoute('home');
    }

    #[Route('/role/assign', name: 'role_assign', methods: ["GET|POST"])]
    public function assignRole(Request $request,SecurityService $securityService)
    {
        $roles = $request->request->all();
        if(empty($roles['roles']))
            dd('you have not selected any role to assign');

        $roles = $roles['roles'];
        $user = $this->getUser();
        $user->setRoles($roles);
        $this->flushService->flushUser($user);

        return $this->redirectToRoute('home');
    }
}