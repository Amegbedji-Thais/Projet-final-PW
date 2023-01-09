<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(CategoriesRepository $categoriesRepository, ManagerRegistry $managerRegistry): Response
    {
        // Récupérer toutes les catégories de la base de données sur CategoriesRepository
        $categories = $categoriesRepository->findAll();

        // Sélectionner trois biens aléatoirement dans la table 'biens'
        $sql = 'SELECT * from biens ORDER BY RAND() LIMIT 3';

        // Récupérer l'entity manager et préparer la requête SQL précédente
        $em = $managerRegistry->getManager();
        $statement = $em->getConnection()->prepare($sql);

        // Exécuter la requête et récupérer les résultats
        $result = $statement->execute()->fetchAll();

        // Tableau devant contenir les biens
        $biens = [];

        // Pour chaque bien récupéré
        foreach ($result as $key => $value) {

            // Initialiser un nouveau bien
            $bien = new Biens();

            // Donner les caractéristiques de biens de la bdd
            $bien->setId($value['id']);

            $bien->setImage($value['image']);

            $bien->setTitreBien($value['titre_bien']);

            $bien->setTypeBien($value['type_bien']);

            $bien->setSurfaceBien($value['surface_bien']);

            $bien->setPrixBien($value['prix_bien']);

            $bien->setLocalisationBien($value['localisation_bien']);

            $bien->setDescriptionBien($value['description_bien']);

            // Récupérer la catégorie du bien par le CategoriesRepository
            $bien->setCategorie($categoriesRepository->findOneBy(array('id' => $value['categorie_id'])));

            // Ajouter le bien dans le tableau précédemment initialisé
            $biens[] = $bien;

        }

        // Retourner la vue 'accueil/accueil.html.twig' avec comme paramètres 'categories' et 'biens'
        return $this->render('accueil/accueil.html.twig', [
            'categories' => $categories,
            'biens' => $biens
        ]);
    }



}
