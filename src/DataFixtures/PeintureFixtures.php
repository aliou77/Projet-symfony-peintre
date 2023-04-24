<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Peinture;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PeintureFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $user = (new User());
       
        

        $user
            ->setNom("Gauthier")
            ->setPrenom("Francois")
            ->setEmail("gauthiers@gmail.com")
            ->setPassword($this->hasher->hashPassword($user, 'admin'))
            ->setTelephone("+2132456985")
            ->setInstagram("http://www.instagram.com")
            ->setApropos("Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi ex a, sint voluptatibus doloremque beatae distinctio. Recusandae fugiat necessitatibus. ")
        ;
        
        
        
        
    }
}
