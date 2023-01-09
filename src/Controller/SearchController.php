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
        $biens = [];

        $searchBiensForm = $this->createForm(SearchBiensType::class);

        if ($searchBiensForm->handleRequest($request)->isSubmitted() && $searchBiensForm->isValid()) {
            $critere = $searchBiensForm->getData();

            $biens = $biensRepo->searchBiens($critere);

        }
        return $this->render('search/index.html.twig', [
            'search_form' => $searchBiensForm->createView(),
            'biens' => $biens,
        ]);
    }
}
