<?php
namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categories", name="admin_categories_")
 * @package App\Controller\Admin
 */
class AdminCategoriesController extends AbstractController
{
    /**
     * @var BienRepository
     */
    private BienRepository $repository;

    /**
     * @var ObjectManager
     */
    private ObjectManager $em;

    public function __construct(BienRepository $repository, ObjectManager $em)
    {
        $this -> repository = $repository;
        $this -> em = $em;
    }

    /**
     * @Route("/admin", name="home")
     */
    public function index(BienRepository $bienRepo)
    {
        return $this->render('admin/bien/index.html.twig', [
            'bien' => $bienRepo->findAll()
        ]);
    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajoutBien(Request $request)
    {
        $bien = new Bien;

        $form = $this->createForm(BienType::class, $bien);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($bien);
            $em->flush();

            return $this->redirectToRoute('admin.bien.index');
        }

        return $this->render('admin/bien/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function ModifCategorie(Bien $bien, Request $request)
    {
        $form = $this->createForm(BienType::class, $bien);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($bien);
            $em->flush();

            return $this->redirectToRoute('admin.bien.index');
        }

        return $this->render('admin/bien/ajout.html.twig', [
            'form' => $form->createView()
        ]);
    }
}