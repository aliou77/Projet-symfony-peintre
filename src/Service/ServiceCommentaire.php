<?php

namespace App\Service;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ServiceCommentaire {

    private $em;
    private $flash;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function persistCommentaire(Commentaire $com, ?Peinture $peinture = null, ?BlogPost $blogPost = null){

        $com
            ->setIsPublished(true)
            ->setCreatedAt(new DateTimeImmutable())
            ->setPeinture($peinture)
            ->setBlogpost($blogPost)
            ;
        $this->em->persist($com);
        $this->em->flush();
    }

}