<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_front_contact')]
    public function show(Request $request, MailerInterface $mailer): Response
    {
        //récup l'user connecté
        /** @var User */
        $user= $this->getUser();
        $form = $this->createForm(ContactType::class, $user);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            
            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('adrien.leprince02@live.fr')
                ->subject($contactFormData['objet'])
                ->text('Sender : '.$contactFormData['email'].\PHP_EOL.
                    $contactFormData['message'],
                    'text/plain');
            $mailer->send($message);

            $this->addFlash('success', 'Vore message a été envoyé');

            return $this->redirectToRoute('app_front_contact');
        }

        return $this->render('front/contact/show.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
