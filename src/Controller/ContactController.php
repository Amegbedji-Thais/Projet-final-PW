<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    //Retourne la vue contact.html.twig
    public function index(): Response
    {
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    //Envoyer un e-mail à partir d'un formulaire de contact sur le site
    #[Route('/mailcontact', name: 'app_mailingcont')]
    public function mail(Request $request, MailerInterface $mailer)
    {
        try {
            //Créer un objet de classe TemplatedEmail en utilisant l'adresse e-mail, le sujet et la vue
            $email = (new TemplatedEmail())
                ->from($request->request->get('email'))
                ->to('safer@safer.safer')
                ->subject('Prise de contact pour un bien recherché !')
                ->htmlTemplate('email/mailcontact.html.twig')
                // pass variables (name => value) to the template
                ->context([
                    'message' => $request->request->get('message'),
                    'telephone' => $request->request->get('telephone'),
                    'nom' => $request->request->get('nom')
                ]);

            //Utiliser l'objet $mailer pour envoyer l'e-mail avec la méthode send
            $mailer->send($email);
            //Message de succès si le message est bien envoyé
            $this->addFlash('success','Mail envoyé');

            //Cas d'échec de l'envoi
        } catch (\Throwable $th) {
            dd($th);
        }
        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
    }
}
