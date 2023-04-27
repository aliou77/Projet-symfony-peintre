<?php

namespace App\Service;

use App\Entity\Contact;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class ServiceContact {

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function persistContact(Contact $contact){
        $contact->setCreatedAt(new DateTimeImmutable());
        $contact->setIsSend(false);

        $this->em->persist($contact);
        $this->em->flush();
    }

    public function isSend(Contact $contact){
        $contact->setIsSend(true);
        
        $this->em->persist($contact);
        $this->em->flush();
    }

}