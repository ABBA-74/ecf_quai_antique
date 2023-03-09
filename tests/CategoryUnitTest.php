<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $category = new Category();

        $category->setName('name')
            ->setSlug('slug');

        $this->assertTrue($category->getName() === 'name');
        $this->assertTrue($category->getSlug() === 'slug');
    }

    public function testIsFalse(): void
    {
        $category = new Category();

        $category->setName('name')
            ->setSlug('slug');
        
        $this->assertFalse($category->getName() === 'false');
        $this->assertFalse($category->getSlug() === 'false');
    }

    public function testIsEmpty(): void
    {
        $category = new Category();

        $this->assertEmpty($category->getName());
        $this->assertEmpty($category->getSlug());
    }

    public function testAddGetRemoveProduct(): void
    {
        $category = new Category();
        $product = new Product();
        
        $this->assertEmpty($category->getProducts());

        $category->addProduct($product);
        $this->assertContains($product, $category->getProducts());

        $category->removeProduct($product);
        $this->assertEmpty($category->getProducts());
    }
}