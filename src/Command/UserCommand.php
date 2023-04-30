<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\Service\ServiceContact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * cette class nous permet d'envoyer des mail au peintre, qui est le proprietaire du site.
 * 
 */
#[AsCommand(name: 'app:create-user')] // est la command a utiliser dans la console
class ContactCommand extends Command{

    private $em;
    private $hasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher)
    {
        $this->em = $em;
        $this->hasher = $hasher;
        parent::__construct();
    }

    public function configure(){
        // les arguments passer en ligne de command
        $this
            ->addArgument("username", InputArgument::REQUIRED, "the username of the user")
            ->addArgument("password", InputArgument::REQUIRED, "the password of the user")
            ;
    }

    /**
     * @return undefined
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();
        $user->setEmail($input->getArgument('username'));

        $pass = $this->hasher->hashPassword($user, $input->getArgument("password"));
        $user->setPassword($pass);

        $user
            ->setRoles(['ROLE_PEINTURE'])
            ->setPrenom("") // champs seront remplie dans le back office
            ->setNom("")
            ->setTelephone("")
            ;

        $this->em->persist($user);
        $this->em->flush($user);
        return Command::SUCCESS;
    }
}
