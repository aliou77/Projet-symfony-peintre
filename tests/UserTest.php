<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testIsTrue(){
        $user = new User();

        $user->setPrenom("mamadou aliou");
        $user->setNom("diallo");
        $user->setTelephone("+221783256589");
        $user->setEmail("aliou@gmail.com");
        $user->setInstagram("aliou@gmail.com");
        $user->setApropos("a propos");
        $user->setPassword("password");

        $this->assertTrue($user->getPrenom() == "mamadou aliou");
        $this->assertTrue($user->getNom() == "diallo");
        $this->assertTrue($user->getTelephone() == "221783256589");
        $this->assertTrue($user->getEmail() == "aliou@gmail.com");
        $this->assertTrue($user->getPassword() == "password");
        $this->assertTrue($user->getApropos() == "a propos");
    }
                

}
