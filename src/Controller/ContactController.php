<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, SluggerInterface $slugger,  MailerInterface $mailer): Response
    {
        $contactForm = $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
        
            if (empty($contactForm['honeypot']->getData())) { // si le pot de miel est vide

             $contact = $contactForm->getData(); //récupère les informations du formulaire
            $email = (new TemplatedEmail())
                ->from(new Address($contact['email'], $contact['firstname'] . ' ' . $contact['lastname'])) // expéditeur
                ->to(new Address('a.matoute@gmail.com')) // destinataire
                ->replyTo(new Address($contact['email'], $contact['firstname'] . ' ' . $contact['lastname']))
                ->htmlTemplate('email/contact_email.html.twig') // chemin du template de mail
                ->context([ // passe les informations au template
                    'firstName' => $contact['firstname'],
                    'lastName' => $contact['lastname'],
                    'message' => $contact['message'],
                    'emailAddress' => $contact['email'],
                ]);
            if ($contact['attachement'] !== null) { // vérifie s'il y a un fichier dans le formulaire
                 
                $originalFilename = pathinfo($contact['attachement']->getClientOriginalName(), PATHINFO_FILENAME); // récupère le nom original du fichier
                $safefilename = $slugger->slug($originalFilename); // nécessaire pour inclure le fichier dans l'URL
                $newFilename = $safefilename . '.' . $contact['attachement']->guessExtension(); // renomme le fichier pour lui ajouter une extension de fichier
                $email->attachFromPath($contact['attachement']->getPathName(), $newFilename); // attache le fichier en pièce-jointe
            }
            $mailer->send($email);
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('contact');
        }else {
                dd('You\'re a f****** robot, man !');
            }
           
    } return $this->render('contact/index.html.twig', [
                'contactForm' => $contactForm->createView()
            ]);
        
}
}