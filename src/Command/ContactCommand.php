<?php

namespace App\Command;

use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\Service\ServiceContact;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

/**
 * cette class nous permet d'envoyer des mail au peintre, qui est le proprietaire du site.
 * 
 */
#[AsCommand(name: 'app:send-email')] // est la command a utiliser dans la console
class ContactCommand extends Command{

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
        parent::__construct();
    }

    /**
     * @return undefined
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // recupere les users dont les messages ne sont pas encore envoyer
        $users = $this->contacRepo->findBy(['isSend' => false]);
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
        return Command::SUCCESS;
    }
}
