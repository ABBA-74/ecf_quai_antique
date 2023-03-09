<?php

namespace App\Tests;

use App\Entity\Product;
use App\Entity\MenuFormula;
use PHPUnit\Framework\TestCase;

class MenuFormulaUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $menuformula = new MenuFormula;

        $menuformula->setName('name')
            ->setDescription('description')
            ->setSlug('test')
            ->setPrice(10.0);

        $this->assertTrue($menuformula->getName() === 'name');
        $this->assertTrue($menuformula->getDescription() === 'description');
        $this->assertTrue($menuformula->getSlug() === 'test');
        $this->assertTrue($menuformula->getPrice() === 10.0);
    }

    public function testIsFalse(): void
    {
        $menuformula = new MenuFormula;

        $menuformula->setName('name')
            ->setDescription('description')
            ->setSlug('test')
            ->setPrice(10.0);

        $this->assertFalse($menuformula->getName() === 'false');
        $this->assertFalse($menuformula->getDescription() === 'false');
        $this->assertFalse($menuformula->getSlug() === 'false');
        $this->assertFalse($menuformula->getPrice() === 9.9);
    }

    public function testIsEmpty(): void
    {
        $menuformula = new MenuFormula;

        $this->assertEmpty($menuformula->getName());
        $this->assertEmpty($menuformula->getDescription());
        $this->assertEmpty($menuformula->getSlug());
        $this->assertEmpty($menuformula->getPrice());
    }

    public function testAddGetRemoveProduct(): void
    {
        $menuformula = new MenuFormula;
        $product = new Product();
        
        $this->assertEmpty($menuformula->getProduct());

        $menuformula->addProduct($product);
        $this->assertContains($product, $menuformula->getProduct());

        $menuformula->removeProduct($product);
        $this->assertEmpty($menuformula->getProduct());
    }
}