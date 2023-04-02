<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistractionController extends AbstractController
{

    #[Route("/register", name: "register", methods: ["GET|POST"])]
    public function index(UserPasswordHasherInterface $passwordHasher)
    {

        $user = new User();
        $plaintextPassword =1;

        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

    }
}