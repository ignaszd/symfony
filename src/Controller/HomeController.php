<?php

namespace App\Controller;

use App\Entity\UserRoles;
use App\Service\DoctrineService;
use App\Service\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $doctrine;
    public function __construct(DoctrineService $doctrineService)
    {
        $this->doctrine = $doctrineService->doctrine;
    }

    #[Route('/home', name: 'home', methods: ["GET|POST"])]
    public function index(SecurityService $securityService): Response
    {
        $roles = $this->doctrine->getRepository(UserRoles::class)->findAll();
        $user = $securityService->getUser();
        return $this->render('home/index.html.twig',[
            'roles' => $roles,
        ]);
    }
}