<?php

namespace App\Controller;

use App\Service\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home', methods: ["GET|POST"])]
    public function index(SecurityService $securityService): Response
    {

        $user = $securityService->getUser();
        return $this->render('home/index.html.twig');
    }
}