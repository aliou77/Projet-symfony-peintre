<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\BlogPost;
use App\Entity\User#__toString();
;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // blogpost
        $faker = Factory::create('fr_FR');
        $user = new User();
        $blogpost = new BlogPost();

        // for($i =0; $i <= 0; $i++){
        //     $blogpost
        //         ->setTitre($faker->words(3, true))
        //         ->setSlug("slug-commentaire-$i")
        //         ->setContenu($faker->words(25, true))
        //         ->setUser($user)
        //     ;
        // }

        // $manager->persist($blogpost);

        // $manager->flush();
    }
}
