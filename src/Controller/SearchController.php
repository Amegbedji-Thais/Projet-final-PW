<?php

namespace App\Controller;

use App\Form\SearchBiensType;
use App\Repository\BiensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/biens/search', name: 'app_search')]
    public function searchBiens(Request $request, BiensRepository $biensRepo)
    {
        //Création de biens vident pour permettre l'utilisations de if dans la vue.
        $biens = [];

        //Nous récupérons les champs du formulaire.
        $searchBiensForm = $this->createForm(SearchBiensType::class);

        //Si le formulaire est valide et que celui-ci à bien été soumis alors nous récupérons les données des champs du formulaire.
        if ($searchBiensForm->handleRequest($request)->isSubmitted() && $searchBiensForm->isValid()) {
            $critere = $searchBiensForm->getData();

            $biens = $biensRepo->searchBiens($critere);

        }

        //Nous renvoyons la vue ainsi que les biens récupérés respectans les données du formulaire.
        return $this->render('search/index.html.twig', [
            'search_form' => $searchBiensForm->createView(),
            'biens' => $biens,
        ]);
    }
}
