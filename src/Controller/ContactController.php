<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ServiceContact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    private $contacRepo;
    private $mailer;
    private $userRepo;
    private $servContact;

    public function __construct(
        ContactRepository $contacRepo, 
        MailerInterface $mailer, 
        UserRepository $userRepo,
        ServiceContact $servContact
        )
    {
        $this->contacRepo = $contacRepo;
        $this->mailer = $mailer;
        $this->userRepo = $userRepo;
        $this->servContact = $servContact;
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request,  ServiceContact $serv): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $serv->persistContact($contact);
            $this->addFlash("success", "Votre message a bien été envoyer !");
            return $this->redirectToRoute("app_home");
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
        ]);
    }

    private function sendEmail(){
         // recupere les users dont les messages ne sont pas encore envoyer
         $users = $this->contacRepo->findAll();
         $peintre = $this->userRepo->getPeintre();
         // recupere l'address du peintre
         $address = new Address($peintre->getEmail(), $peintre->getNom() . " ". $peintre->getPrenom());

         foreach($users as $user){
             $email = (new Email())
                 ->from($user->getEmail())
                 ->to($address)
                 ->subject("nouveau message de " . $user->getNom())
                 ->text($user->getMessage());
             
                 $this->mailer->send($email);

                 $this->servContact->isSend($user);
         }
    }
}
