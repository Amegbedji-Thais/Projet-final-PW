<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Favoris;
use App\Repository\FavorisRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class FavorisController extends AbstractController
{
    private $entityManager;

    //Constructeur
    public function __construct(EntityManagerInterface $entityManager, FavorisRepository $favorisRepository)
    {
        $this->entityManager = $entityManager;
        $this->favorisRepository = $favorisRepository;

    }

    #[Route('/favoris', name: 'app_favoris')]
    public function ind(Request $request): Response
    {
        //Récupérer la session actuelle à partir de la requête et récupérer l'adresse email de l'utilisateur stockée dans la session
        $session = $request->getSession();
        $mailUser = $session->get('email');

        //Si aucune adresse email n'est trouvée dans la session, l'utilisateur n'est pas connecté
        // et un formulaire de connexion s'affiche
        if(!$mailUser){
            $favoris = new Favoris();
            $form = $this->createFormBuilder($favoris)
                ->add('mail_fav', EmailType::class)
                ->getForm();

            $form->handleRequest($request);
            //Si l'utilisateur soumet le formulaire, l'adresse mail qu'il a entrée est enregistrée dans
            // la session et utilisée pour récupérer ses favoris
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

            //S'il est déjà connecté, les favoris sont simplement récupérés depuis la bdd
            // en utilisant l'adresse stockée dans la session
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
        //Chercher si le bien est déjà dans la liste de favoris de l'utilisateur en utilisant la méthode findBy()
        $favoris = $this->favorisRepository->findBy(array('mail_fav'=>$mail_fav, 'bien'=> $biens->getId()));
        //Si oui un message d'alerte est affiché
        if($favoris){
            $this->addFlash('danger','Vous avez deja ce bien en favoris');
        }
        //Sinon ajouté le bien en favori et afficher un message pour le notifier à l'utilisateur
        else{
            $favoris = new Favoris();
            $favoris->setMailFav($mail_fav);
            $favoris->setBien($biens);
            $favoris->setSend(false);
            $this->entityManager->persist($favoris);
            $this->entityManager->flush();
            $this->addFlash('success','Bien ajouté en favoris');
        }

        return $this->redirectToRoute('app_favoris', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/favoris/remove/{id}', name: 'app_lesfavorissup')]
    //Retirer un bien des favoris
    public function removeFav(Favoris $favoris){
        $this->addFlash('success','Bien supprimé avec succes');
        $this->favorisRepository->remove($favoris, true);
        return $this->redirectToRoute('app_favoris', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/laymail', name: 'app_mailing')]
    //Envoyer les favoris par mail
    public function mailing(Request $request, MailerInterface $mailer){
        //Récupérer la session à partir de la requête et de récupérer
        // le mail de l'utilisateur dans la session
        $session = $request->getSession();
        $mailUser = $session->get('email');

        //Si l'utilisateur est connecté, la fonction récupère la liste de favoris non envoyés de l'utilisateur
        // en utilisant la méthode 'findBy'
        if($mailUser){
            $favoris = $this->favorisRepository->findBy(array('mail_fav' => $mailUser, 'send' => false));
            try {
                //TemplatedEmail est créée et configurée avec les infos du mail à envoyer
                $email = (new TemplatedEmail())
                    ->from('safer@mail.com')
                    ->to($mailUser)
                    ->subject('Liste des bien favoris!')
                    ->htmlTemplate('email/laymail.html.twig')

                    // pass variables (name => value) to the template
                    ->context([
                        'favoris' => $favoris
                    ])
                ;

                //La méthode send() de l'objet mailer est appelée pour envoyer l'e-mail
                $mailer->send($email);


            }catch (\Throwable $th){
                dd($th);
            }
        }

        //Si aucun mail n'est trouvée dans la session, alors l'utilisateur n'est pas connecté
        // et la fonction s'arrête

        return $this->redirectToRoute('app_favoris', [], Response::HTTP_SEE_OTHER);
    }
}
