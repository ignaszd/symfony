<?php

namespace App\Controller;

use App\Service\SecurityService;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    #[Route('/home', name: 'home', methods: ["GET|POST"])]
    public function index(SecurityService $securityService)
    {
        $user = $securityService->getUser();
        dd($user);
    }
}