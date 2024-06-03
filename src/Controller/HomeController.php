<?php

namespace App\Controller;

use App\Entity\Tuto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $tutos = $entityManager->getRepository(Tuto::class)->findAll();

        return $this->render('home/index.html.twig', [
            'tutos' => $tutos,
        ]);
    }
}
