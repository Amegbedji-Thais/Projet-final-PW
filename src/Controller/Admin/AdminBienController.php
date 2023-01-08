<?php
namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
//use Doctrine\ORM\EntityManager;
//use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/bien", name="admin_bien_")
 * @package App\Controller\Admin
 */
class AdminBienController extends AbstractController
{
    /**
     * @var BienRepository
     */
    private BienRepository $repository;




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
     * @Route("/admin/ajout", name="admin.bien.ajout", methods="GET|POST")
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
     * @Route("admin/modifier/{id}", name="admin.bien.modifier")
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