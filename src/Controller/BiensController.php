<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Form\SearchForm;
use App\Repository\BiensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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



    #[Route('/biens', name: 'app_bienssearch')]
    public function indexsearch(BiensRepository $repository, Request $request): Response
    {
       $data = new SearchData();
       $form = $this->createForm(SearchForm::class, $data);
       $form->handleRequest($request);
       $biens = $repository->findSearch();
        return $this->render('biens/biens.html.twig', [
            'biens' => $biens,
            'form' => $form->createView()
        ]);
    }


    #[Route('/details/{id}', name: 'app_details')]
    public function ind($id, BiensRepository $biensRepository): Response
    {
        //$biens = $this->entityManager->getRepository(Biens::class)->findAll();
        // $biens = $this->entityManager->getRepository(Biens::class)->findBy(['bien'=> $biensRepository->find($id)]);
         $bien = $biensRepository->find($id);
        return $this->render('biens/details.html.twig', [
            'bien' => $bien
        ]);
    }
}
