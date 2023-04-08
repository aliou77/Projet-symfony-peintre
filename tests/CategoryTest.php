<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Category;

class CategoryTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function TestIsTrue(){
        $cat = new Category();

        $cat->setNom("cat1");
        $cat->setDescription("description");
        $cat->setSlug("cat-1");

        $this->assertTrue($cat->getNom() == "cat1");
        $this->assertTrue($cat->getDescription() == "description");
        $this->assertTrue($cat->getSlug() == "cat-1");
    }
}
