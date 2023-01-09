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
        //Récupérer tous biens de la bdd en utilisant avec l'entity manager et le repository de la classe Biens
        $biens = $this->entityManager->getRepository(Biens::class)->findAll();

        //Retourner la vue 'biens/biens.html.twig' en passant la variable $biens
        return $this->render('biens/biens.html.twig', [
            'biens' => $biens
        ]);
    }



    #[Route('/biens', name: 'app_bienssearch')]
    //Afficher une liste de tous les biens en utilisant les données soumises au formulaire.
    public function indexsearch(BiensRepository $repository, Request $request): Response
    {
        //Créer un objet de classe SearchData et un formulaire avec la classe SearchForm et l'objet SearchData
       $data = new SearchData();
       //Récupérer tous les objets de Biens dans la bdd en utilisant la méthode findSearch de la classe BiensRepository
       $form = $this->createForm(SearchForm::class, $data);
       $form->handleRequest($request);
       $biens = $repository->findSearch();
       //Retourne la vue 'biens/biens.html.twig' et passe les variables $biens et $form (formulaire de recherche)
        return $this->render('biens/biens.html.twig', [
            'biens' => $biens,
            'form' => $form->createView()
        ]);
    }

    //Afficher les détails d'un bien donné
    #[Route('/details/{id}', name: 'app_details')]
    public function ind($id, BiensRepository $biensRepository): Response
    {

        //Récupérer un objet de Biens dans la bdd en utilisant l'identifiant passé en argument et la méthode find
         $bien = $biensRepository->find($id);
         //Retourner la vue en passant $bien
        return $this->render('biens/details.html.twig', [
            'bien' => $bien
        ]);
    }
}
