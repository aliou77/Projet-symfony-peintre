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
        
        for($i = 0; $i <= 5; $i++){
            $cat = new Category();
            $cat
                ->setNom($faker->words(1, true))
                ->setDescription($faker->words(35, true))
                ->setSlug("slug-category-". $i+1)
                ;
            $manager->persist($cat);

            for($j = 0; $j <= 5; $j++){
                $peinture = new Peinture();
                $peinture
                    ->setNom("peinture-". ($i+$j))
                    ->setDescription($faker->words(30, true))
                    ->setSlug("peinture-slug-". ($i+$j))
                    ->setLongeur($faker->numberBetween(10, 25))
                    ->setLarger($faker->numberBetween(10, 25))
                    ->setPrix($faker->numberBetween(20000, 60000))
                    ->setDateRealisation($faker->dateTimeBetween('march', 'now'))
                    ->setDatePublication($faker->dateTimeBetween('march', 'now'))
                    ->setEnVente($faker->randomElement(['false', 'true']))
                    ->setPortfolio($faker->randomElement(['false', 'true']))
                    ->setUser($user)
                    ->addCategory($cat)
                    ->setImage("imgs/download.jpg")
                ;
                $manager->persist($peinture);
            }
            
            $manager->flush();
        }
        
        
        
    }
}
