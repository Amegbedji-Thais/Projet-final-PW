<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Form\BiensType;
use App\Repository\BiensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/biens')]
class AdminBiensController extends AbstractController
{
    #[Route('/', name: 'app_admin_biens_index', methods: ['GET'])]
    //Objectif : afficher tous les biens de la bdd
    public function index(BiensRepository $biensRepository): Response
    {
        //Retourne la vue 'admin_biens/index.html.twig'
        return $this->render('admin_biens/index.html.twig', [
            //Récupérer tous les biens stockés dans la bdd
            'biens' => $biensRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_biens_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BiensRepository $biensRepository): Response
    {
        //Créer un nouvel objet bien Biens et le stocker dans $bien
        $bien = new Biens();

        //Créer un formulaire avec la classe BiensType et $bien, et gère une requête en utilisant le formulaire
        $form = $this->createForm(BiensType::class, $bien);
        $form->handleRequest($request);

        //Si le formulaire soumis est valide appeler la méthode save(BiensRepository) avec $bien en tant qu'argument et true en deuxième argument
        if ($form->isSubmitted() && $form->isValid()) {
            $biensRepository->save($bien, true);

            return $this->redirectToRoute('app_admin_biens_index', [], Response::HTTP_SEE_OTHER);
        }

       //Si le formulaire n'est pas soumis ou pas valide retourner la vue 'admin_bien' avec les variables $bien et $form.
        return $this->renderForm('admin_biens/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_biens_show', methods: ['GET'])]
    public function show(Biens $bien): Response
    {
        //Retourne la vue 'admin_biens/show.html.twig' avec $bien comme argument
        return $this->render('admin_biens/show.html.twig', [
            'bien' => $bien,
        ]);
    }

    //Arguments : requête, objet de Biens et objet de la classe BiensRepository
    #[Route('/{id}/edit', name: 'app_admin_biens_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Biens $bien, BiensRepository $biensRepository): Response
    {
        //Créer un formulaire de la classe BiensType avec l'objet Biens passé en argument,
        // puis gérer la requête HTTP en utilisant ce formulaire
        $form = $this->createForm(BiensType::class, $bien);
        $form->handleRequest($request);

        //Si le formulaire est soumis et valide, la méthode save de BiensRepository est appelée avec
        // Biens et true
        if ($form->isSubmitted() && $form->isValid()) {
            $biensRepository->save($bien, true);

            //Retourne la vue
            return $this->redirectToRoute('app_admin_biens_index', [], Response::HTTP_SEE_OTHER);
        }

        //Sinon (le formulaire n'est pas soumis ou pas valide) retourner la vue edit avec les variables $bien et $form.
        return $this->renderForm('admin_biens/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_biens_delete', methods: ['POST'])]
    //Vérifie si le CSRF soumis avec la requête est valide.
    public function delete(Request $request, Biens $bien, BiensRepository $biensRepository): Response
    {
        //S'il est valide appeler la méthode remove de BiensRepository avec l'objet Biens et true
        if ($this->isCsrfTokenValid('delete'.$bien->getId(), $request->request->get('_token'))) {
            $biensRepository->remove($bien, true);
        }

        //Rediriger vers la route indiquée
        return $this->redirectToRoute('app_admin_biens_index', [], Response::HTTP_SEE_OTHER);
    }
}
