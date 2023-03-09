<?php

namespace App\Tests;

use App\Entity\Image;
use App\Entity\Allergy;
use App\Entity\Formula;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\MenuFormula;
use PHPUnit\Framework\TestCase;

class ProductUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $product = new Product();
        $category = new Category();

        $product->setName('name')
            ->setDescription('description')
            ->setIsFavorite(true)
            ->setPrice(10.0)
            ->setSlug('slug')
            ->setCategory($category);

        $this->assertTrue($product->getName() === 'name');
        $this->assertTrue($product->getDescription() === 'description');
        $this->assertTrue($product->getIsFavorite() === true);
        $this->assertTrue($product->getPrice() === 10.0);
        $this->assertTrue($product->getSlug() === 'slug');
        $this->assertTrue($product->getCategory() === $category);
    }

    public function testIsFalse(): void
    {
        $product = new Product();
        $category = new Category();

        $product->setName('name')
            ->setDescription('description')
            ->setIsFavorite(true)
            ->setPrice(10.0)
            ->setSlug('slug')
            ->setCategory($category);

        $this->assertFalse($product->getName() === 'false');
        $this->assertFalse($product->getDescription() === 'false');
        $this->assertFalse($product->getIsFavorite() === false);
        $this->assertFalse($product->getPrice() === 99.9);
        $this->assertFalse($product->getSlug() === 'false');
        $this->assertFalse($product->getCategory() === new Category());
    }

    public function testIsEmpty(): void
    {
        $product = new Product();

        $this->assertEmpty($product->getName());
        $this->assertEmpty($product->getDescription());
        $this->assertEmpty($product->getIsFavorite());
        $this->assertEmpty($product->getPrice());
        $this->assertEmpty($product->getSlug());
        $this->assertEmpty($product->getCategory());
    }

    public function testAddGetRemoveAllergy(): void
    {
        $product = new Product();
        $allergy = new Allergy();
        
        $this->assertEmpty($product->getAllergies());

        $product->addAllergy($allergy);
        $this->assertContains($allergy, $product->getAllergies());

        $product->removeAllergy($allergy);
        $this->assertEmpty($product->getAllergies());
    }

    public function testAddGetRemoveMenuFormula(): void
    {
        $product = new Product();
        $menuformula = new MenuFormula();
        
        $this->assertEmpty($product->getMenuFormulas());

        $product->addMenuFormula($menuformula);
        $this->assertContains($menuformula, $product->getMenuFormulas());

        $product->removeMenuFormula($menuformula);
        $this->assertEmpty($product->getMenuFormulas());
    }

    public function testAddGetRemoveImage(): void
    {
        $product = new Product();
        $image = new Image();
        
        $this->assertEmpty($product->getImages());

        $product->addImage($image);
        $this->assertContains($image, $product->getImages());

        $product->removeImage($image);
        $this->assertEmpty($product->getImages());
    }
}