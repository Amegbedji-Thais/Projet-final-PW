<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Repository\BiensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class BiensController extends AbstractController
{
    private $entityManager;


     public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    #[Route('/biens', name: 'app_biens')]
    public function index(): Response
    {
        $biens = $this->entityManager->getRepository(Biens::class)->findAll();
        return $this->render('biens/biens.html.twig', [
            'biens' => $biens
        ]);
    }

    /**
    #[Route('/biens', name: 'app_bienssearch')]
    public function indexsearch(BiensRepository $repository): Response
    {
       //$data = new SearchData();
       $biens = $repository->findSearch();
        return $this->render('biens/biens.html.twig', [
            'biens' => $biens
        ]);
    }
    */

    #[Route('/details', name: 'app_details')]
    public function ind(): Response
    {
        //$biens = $this->entityManager->getRepository(Biens::class)->findAll();
        return $this->render('biens/details.html.twig', [
            'controller_name' => 'BiensController',
        ]);
    }
}
