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
    public function index(): Response
    {
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    #[Route('/mailcontact', name: 'app_mailingcont')]
    public function mail(Request $request, MailerInterface $mailer)
    {
        try {
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

            $mailer->send($email);
            $this->addFlash('success','Mail envoyé');
        } catch (\Throwable $th) {
            dd($th);
        }
        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
    }
}
