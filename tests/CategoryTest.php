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

    public function TestIsFalse(){
        $cat = new Category();

        $cat->setNom("cat1");
        $cat->setDescription("description");
        $cat->setSlug("cat-1");

        $this->assertFalse($cat->getNom() == "false");
        $this->assertFalse($cat->getDescription() == "false");
        $this->assertFalse($cat->getSlug() == "false");
    }

    public function testIsEmpty() {
        $cat = new Category();

        $this->assertEmpty($cat->getNom());
        $this->assertEmpty($cat->getDescription());
        $this->assertEmpty($cat->getSlug());
    }
}
