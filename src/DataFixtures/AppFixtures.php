<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\BlogPost;
use App\Entity\Category;
use App\Entity\Peinture;
use App\Entity\User#__toString();
;
use DateTimeImmutable;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        
        // blogpost
        $faker = Factory::create('fr_FR');
        $user = new User();
        

        
        $user
            ->setNom("Gauthier")
            ->setPrenom("Francois")
            ->setEmail("francois@gmail.com")
            ->setPassword($this->hasher->hashPassword($user, 'admin'))
            ->setTelephone("+2132456985")
            ->setInstagram("http://www.instagram.com")
            ->setApropos("Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi ex a, sint voluptatibus doloremque beatae distinctio. Recusandae fugiat necessitatibus. ")
            ->setRoles(['ROLE_PEINTRE'])
            ;
            $manager->persist($user);

        for($i = 0; $i <= 20; $i++){
            $blogpost = new BlogPost();
            $blogpost
                ->setTitre($faker->words(3, true))
                ->setSlug($faker->word)
                ->setCreatedAt($faker->dateTimeBetween('march', 'now'))
                ->setContenu($faker->words(25, true))
                ->setUser($user)
            ;
            $manager->persist($blogpost);
        }
        

        for($i = 0; $i <= 5; $i++){
            $cat = new Category();
            $cat
                ->setNom($faker->words(1, true))
                ->setDescription($faker->words(35, true))
                ->setSlug($faker->word)
                // ->setSlug("slug-category-". $i+1)
                ;
            $manager->persist($cat);

            for($j = 0; $j <= 5; $j++){
                $peinture = new Peinture();
                $peinture
                    ->setNom($faker->words(3, true))
                    ->setDescription($faker->words(30, true))
                    ->setSlug($faker->word)
                    ->setLongueur($faker->numberBetween(10, 25))
                    ->setLargeur($faker->numberBetween(10, 25))
                    ->setPrix($faker->numberBetween(20000, 60000))
                    ->setDateRealisation($faker->dateTimeBetween('march', 'now'))
                    ->setDatePublication($faker->dateTimeBetween('march', 'now'))
                    ->setEnVente($faker->randomElement(['false', 'true']))
                    ->setPortfolio($faker->randomElement(['false', 'true']))
                    ->setImage("peinture.png")
                    ->setUser($user)
                    ->addCategory($cat)
                ;
                $manager->persist($peinture);
            }
            $manager->flush();
        }
        
        $manager->flush();
    }
}
