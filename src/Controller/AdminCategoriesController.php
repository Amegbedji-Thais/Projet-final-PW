<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/categories')]
class AdminCategoriesController extends AbstractController
{
    // Retourne la vue 'admin_categories/index.html.twig' et lui passe la variable $categories
    #[Route('/', name: 'app_admin_categories_index', methods: ['GET'])]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('admin_categories/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoriesRepository $categoriesRepository): Response
    {
        //Crée un nouvel objet de la classe Categories et un formulaire de CategoriesType et de Categories.
        // Elle gère ensuite la requête par ce formulaire.
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        //Si le formulaire est soumis et valide, la méthode save est appelée avec l'objet Categories et true
        // en tant qu'arguments
        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesRepository->save($category, true);

            return $this->redirectToRoute('app_admin_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        //Sinon la méthode save est appelée avec l'objet Categories et true en tant qu'arguments
        return $this->renderForm('admin_categories/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    //Afficher les détails d'une catégorie donnée sur la vue 'admin_categories/show.html.twig'
    #[Route('/{id}', name: 'app_admin_categories_show', methods: ['GET'])]
    public function show(Categories $category): Response
    {
        return $this->render('admin_categories/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categories $category, CategoriesRepository $categoriesRepository): Response
    {
        // Crée un formulaire de la classe CategoriesType et de l'objet Categories et gère la requête avec ce formulaire.
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        //Si le formulaire est soumis et valide appeler la méthode save avec l'objet Categories et true en tant qu'arguments
        if ($form->isSubmitted() && $form->isValid()) {
            $categoriesRepository->save($category, true);

            return $this->redirectToRoute('app_admin_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        //Sinon retourner la vue avec les variables $category et $form.
        return $this->renderForm('admin_categories/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_categories_delete', methods: ['POST'])]
    public function delete(Request $request, Categories $category, CategoriesRepository $categoriesRepository): Response
    {
        // Vérifie si le CSRF soumis avec la requête est valide et appeler la méthode remove s'il est valide
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $categoriesRepository->remove($category, true);
        }

        //Retourner la vue sinon
        return $this->redirectToRoute('app_admin_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}
