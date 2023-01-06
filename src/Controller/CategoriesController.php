<?php

namespace App\Controller;

use App\Entity\Biens;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class CategoriesController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

     #[Route("/terrains", name:'app_terrains')]

    public function terr(): Response
    {
        $biens = $this->entityManager->getRepository(Biens::class)->findBy(['categorie'=> 1]);
        return $this->render('categories/terrains.html.twig', [
            'biens' => $biens,
        ]);
    }

    #[Route("/prairies", name:'app_prairies')]

    public function prair(): Response
    {
        $biens = $this->entityManager->getRepository(Biens::class)->findBy(['categorie'=> 2]);
        return $this->render('categories/prairies.html.twig', [
            'biens' => $biens,
        ]);
    }

    #[Route("/bois", name:'app_bois')]

    public function boi(): Response
    {
        $biens = $this->entityManager->getRepository(Biens::class)->findBy(['categorie' => 4]);
        return $this->render('categories/bois.html.twig', [
            'biens' => $biens,
        ]);
    }
    #[Route("/batiment", name:'app_batiment')]

    public function bat(): Response
    {
        $biens = $this->entityManager->getRepository(Biens::class)->findBy(['categorie' => 3]);
        return $this->render('categories/batiments.html.twig', [
            'biens' => $biens,
        ]);
    }

    #[Route("/exploitation", name:'app_exploitation')]

    public function exp(): Response
    {
        $biens = $this->entityManager->getRepository(Biens::class)->findBy(['categorie'=> 5]);
        return $this->render('categories/exploitation.html.twig', [
            'biens' => $biens,
        ]);
    }
}
