<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class CategoriesController extends AbstractController
{
    private $entityManager;


    //Constructeur
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

     #[Route("/category/biens/{name}", name:'app_cat_biens')]

    public function listeBiensParNom($name, CategoriesRepository $categoriesRepository): Response
    {
        //Récupérer tous les objets de Biens dans la bdd qui appartiennent à la catégorie nommée
        // en utilisant la méthode findBy du repository de la classe Biens et la méthode findOneBy du repository de la classe Categories
        $biens = $this->entityManager->getRepository(Biens::class)->findBy(['categorie'=> $categoriesRepository->findOneBy(array('titre_cat' => $name))->getId()]);
        return $this->render('categories/details.html.twig', [
            'biens' => $biens,
            'name' => $name
        ]);
    }
}
