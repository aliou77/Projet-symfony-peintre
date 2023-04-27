<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface{

    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubscribedEvents(){

        return [
            // lorsque cet evenement sera declancher il appelera la method setBlogPostSlugAndDateaAndUser
            // l'event sera lancer avant le persist des data du nouveau blogpost (easyAdmin) dans la DB.
            BeforeEntityPersistedEvent::class => ["setBlogPostSlugAndDateaAndUser"]
        ];
    }

    public function setBlogPostSlugAndDateaAndUser(BeforeEntityPersistedEvent $event){
        // recupere l'instance de BlogPost
        $entity = $event->getEntityInstance();

        if(!$entity instanceof BlogPost){
            return;
        }
        // definition du slug apres l'avoir slugifier
        $slug = $this->slugger->slug($entity->getTitre());
        $entity->setSlug($slug);
        // definition de la date
        $entity->setCreatedAt(new DateTime());
        // recupere et definit le user qui s'est connecter au back office (EasyAdmin)
        $entity->setUser($this->security->getUser()); // 
    }
}