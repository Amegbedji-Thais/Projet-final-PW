<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Favoris;
use App\Repository\FavorisRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class FavorisController extends AbstractController
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager, FavorisRepository $favorisRepository)
    {
        $this->entityManager = $entityManager;
        $this->favorisRepository = $favorisRepository;

    }

    #[Route('/favoris', name: 'app_favoris')]
    public function ind(Request $request): Response
    {
        $session = $request->getSession();
        $mailUser = $session->get('email');
        if(!$mailUser){
            $favoris = new Favoris();
            $form = $this->createFormBuilder($favoris)
                ->add('mail_fav', EmailType::class)
                ->getForm();

            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $mailUser = $form->getData()->getMailFav();
                $session->set('email', $mailUser);
                $favoris = $this->favorisRepository->findBy(array('mail_fav' => $mailUser, 'send' => false));
            }else{
                return $this->renderForm('/favoris/forms.html.twig', [
                    'favoris' => $favoris,
                    'form' => $form,
                ]);
            }
        }else{
            $favoris = $this->favorisRepository->findBy(array('mail_fav' => $mailUser, 'send' => false));
        }
        return $this->render('favoris/favoris.html.twig', [
        'biens' => $favoris
        ]);
    }

    #[Route('/favoris/{id}', name: 'app_lesfavoris')]
    public function add(Request $request, Biens $biens): Response
    {
        $session = $request->getSession();
        $mailUser = $session->get('email');
        if(!$mailUser){
            $favoris = new Favoris();
            $form = $this->createFormBuilder($favoris)
                    ->add('mail_fav', EmailType::class)
                    //->add('save', SubmitType::class, ['label' =>'Soumettre'])
                    ->getForm();

            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $mailUser = $form->getData()->getMailFav();
                $session->set('email', $mailUser);
                return $this->addFav($biens, $mailUser);
            }else{
                return $this->renderForm('/favoris/forms.html.twig', [
                    'favoris' => $favoris,
                    'form' => $form,
                ]);
            }
        }else{
            return $this->addFav($biens, $mailUser);
        }
    }

    public function addFav(Biens $biens, $mail_fav){
        $favoris = $this->favorisRepository->findBy(array('mail_fav'=>$mail_fav, 'bien'=> $biens->getId()));
        if($favoris){
            $this->addFlash('danger','Vous avez deja ce bien en favoris');
        }
        else{
            $favoris = new Favoris();
            $favoris->setMailFav($mail_fav);
            $favoris->setBien($biens);
            $favoris->setSend(false);
            $this->entityManager->persist($favoris);
            $this->entityManager->flush();

        }

        return $this->redirectToRoute('app_favoris', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/favoris/remove/{id}', name: 'app_lesfavorissup')]
public function removeFav(Favoris $favoris){
        $this->favorisRepository->remove($favoris, true);
        return $this->redirectToRoute('app_favoris', [], Response::HTTP_SEE_OTHER);
    }
}
