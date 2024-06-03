<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SigninType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SigninController extends AbstractController
{
    #[Route('/signin', name: 'app_signin')]
    public function index(Request $req, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        $form = $this->createForm(SigninType::class, $user);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();

            $plaintextPassword = $user->getPassword();

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();
            // Afficher un message pour dire 'OK' !
        } else {
            // Afficher une erreur
        }

        return $this->render('signin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
