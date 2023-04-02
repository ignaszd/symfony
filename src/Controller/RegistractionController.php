<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Service\ValidationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistractionController extends AbstractController
{
    private $doctrine;
    protected $validationService;
    public function __construct(
        ManagerRegistry $managerRegistry,
        ValidationService $validationService
    )
    {
        $this->doctrine = $managerRegistry;
        $this->validationService = $validationService;
    }

    #[Route("/register", name: "register", methods: ["GET|POST"])]
    public function index(UserPasswordHasherInterface $passwordHasher, Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if($this->validationService->checkIfEmployeeExists($form))
                die(var_dump('employee already exists'));

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $form->getData()->getPassword()
            );
            $user->setPassword($hashedPassword);
            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/index.html.twig', [
            'form' => $form,
        ]);

    }
}