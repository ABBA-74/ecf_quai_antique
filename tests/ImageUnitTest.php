<?php

namespace App\Tests;

use App\Entity\Image;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ImageUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $image = new Image;
        $product = new Product;

        $image->setFilename('test/test.jpeg')
            ->setName('name')
            ->setDescription('description')
            ->setSlug('test')
            ->setProduct($product);

        $this->assertTrue($image->getFilename() === 'test/test.jpeg');
        $this->assertTrue($image->getName() === 'name');
        $this->assertTrue($image->getDescription() === 'description');
        $this->assertTrue($image->getSlug() === 'test');
        $this->assertTrue($image->getProduct() === $product);
    }

    public function testIsFalse(): void
    {
        $image = new Image;
        $product = new Product;

        $image->setFilename('test/test.jpeg')
            ->setName('name')
            ->setDescription('description')
            ->setSlug('test')
            ->setProduct($product);

        $this->assertFalse($image->getFilename() === 'test/false.jpeg');
        $this->assertFalse($image->getName() === 'false');
        $this->assertFalse($image->getDescription() === 'false');
        $this->assertFalse($image->getSlug() === 'false');
        $this->assertFalse($image->getProduct() === new Product());
    }

    public function testIsEmpty(): void
    {
        $image = new Image;

        $this->assertEmpty($image->getFilename());
        $this->assertEmpty($image->getName());
        $this->assertEmpty($image->getDescription());
        $this->assertEmpty($image->getSlug());
        $this->assertEmpty($image->getProduct());
    }
}