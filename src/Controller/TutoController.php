<?php

namespace App\Controller;

use App\Entity\Tuto;
use App\Repository\TutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TutoController extends AbstractController
{
    #[Route('/tuto/{slug}', name: 'app_tuto_details')]
    public function view(EntityManagerInterface $entityManager, string $slug): Response
    {
        $tuto = $entityManager->getRepository(Tuto::class)->findOneBySlug($slug);
        
        if (!$tuto) {
            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('tuto/details.html.twig', [
            'tuto' => $tuto
        ]);
    }

    #[Route('/tuto/{id}', name: 'app_tuto')]
    public function index(TutoRepository $productRepository, int $id): Response
    {
        // $product = $entityManager->getRepository(Tuto::class)->find($id);
        $product = $productRepository->findOneById($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        
        return $this->render('tuto/index.html.twig', [
            'controller_name' => 'TutoController',
            'name' => $product->getName()
        ]);
    }

    #[Route('/add-tuto', name: 'create_tuto')]
    public function createTuto(EntityManagerInterface $entityManager): Response
    {
        $product = new Tuto();
        $product->setName('Unity');
        $product->setSlug('tuto-unity');
        $product->setSubtitle('Lorem ipsum dolor sit amet.');
        $product->setDescription('Lorem ipsum dolor sit amet.');
        $product->setImage('unity.png');
        $product->setVideo('B6eqb-1IoQw');
        $product->setLink('https://www.formation-facile.fr/formations/formation-unity-et-c-developpeur-de-jeux-video');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

}
