<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {       
        $user = new User();
        
        // $user
        //     ->setNom("Gauthier")
        //     ->setPrenom("Francois")
        //     ->setEmail("francois@gmail.com")
        //     ->setPassword($this->hasher->hashPassword($user, 'admin'))
        //     ->setTelephone("+2132456985")
        //     ->setInstagram("http://www.instagram.com")
        //     ->setApropos("Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi ex a, sint voluptatibus doloremque beatae distinctio. Recusandae fugiat necessitatibus. ")
        // ;

        // $manager->persist($user);
        // $manager->flush();
    }
}
