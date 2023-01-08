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
    public function index(BiensRepository $biensRepository): Response
    {
        return $this->render('admin_biens/index.html.twig', [
            'biens' => $biensRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_biens_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BiensRepository $biensRepository): Response
    {
        $bien = new Biens();
        $form = $this->createForm(BiensType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $biensRepository->save($bien, true);

            return $this->redirectToRoute('app_admin_biens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_biens/new.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_biens_show', methods: ['GET'])]
    public function show(Biens $bien): Response
    {
        return $this->render('admin_biens/show.html.twig', [
            'bien' => $bien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_biens_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Biens $bien, BiensRepository $biensRepository): Response
    {
        $form = $this->createForm(BiensType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $biensRepository->save($bien, true);

            return $this->redirectToRoute('app_admin_biens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_biens/edit.html.twig', [
            'bien' => $bien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_biens_delete', methods: ['POST'])]
    public function delete(Request $request, Biens $bien, BiensRepository $biensRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bien->getId(), $request->request->get('_token'))) {
            $biensRepository->remove($bien, true);
        }

        return $this->redirectToRoute('app_admin_biens_index', [], Response::HTTP_SEE_OTHER);
    }
}
