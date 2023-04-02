<?php

namespace App\Controller;

use App\Service\ValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends AbstractController
{
    private $validationService;
    public function __construct(ValidationService $validationService)
    {
        $this->validationService = $validationService;
    }

    #[Route('/role/create', name: 'role_create', methods: ["GET|POST"])]
    public function assignRole(Request $request)
    {
        $role = $request->request->get('new_role');
        if($this->validationService->checkIfRoleExist($role))
            dd('Role already exist');

        return $this->redirectToRoute('home');
    }
}