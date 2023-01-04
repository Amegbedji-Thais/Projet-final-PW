<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/terrains", name="app_terrains")
     */
    public function terr(): Response
    {
        return $this->render('categories/terrains.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    /**
     * @Route("/prairies", name="app_prairies")
     */
    public function prair(): Response
    {
        return $this->render('categories/prairies.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    /**
     * @Route("/bois", name="app_bois")
     */
    public function boi(): Response
    {
        return $this->render('categories/bois.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    /**
     * @Route("/batiment", name="app_batiment")
     */
    public function bat(): Response
    {
        return $this->render('categories/batiments.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    /**
     * @Route("/exploitation", name="app_exploitation")
     */
    public function exp(): Response
    {
        return $this->render('categories/exploitation.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }
}
