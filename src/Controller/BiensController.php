<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BiensController extends AbstractController
{
    /**
     * @Route("/bien", name="app_biens")
     */
    public function index(): Response
    {
        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BiensController',
        ]);
    }
}
