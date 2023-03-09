<?php

namespace App\Tests;

use App\Entity\Allergy;
use App\Entity\Product;
use App\Entity\Reservation;
use App\Entity\User;
use phpDocumentor\Reflection\Types\Void_;
use PHPUnit\Framework\TestCase;

class AllergyUnitTest extends TestCase
{
    public function testIsTrue(): Void
    {
        $allergy = new Allergy();
        
        $allergy->setName('name');

        $this->assertTrue($allergy->getName() === 'name');
    }

    public function testIsFalse(): Void
    {
        $allergy = new Allergy();
        
        $allergy->setName('name');

        $this->assertFalse($allergy->getName() === 'false');
    }

    public function testIsEmpty(): Void
    {
        $allergy = new Allergy();        

        $this->assertEmpty($allergy->getName());
    }

    public function testAddGetRemoveProduct(): void
    {
        $allergy = new Allergy();
        $product = new Product();
        
        $this->assertEmpty($allergy->getProducts());

        $allergy->addProduct($product);
        $this->assertContains($product, $allergy->getProducts());

        $allergy->removeProduct($product);
        $this->assertEmpty($allergy->getProducts());
    }

    public function testAddGetRemoveReservation(): void
    {
        $allergy = new Allergy();
        $reservation = new Reservation();
        
        $this->assertEmpty($allergy->getReservations());

        $allergy->addReservation($reservation);
        $this->assertContains($reservation, $allergy->getReservations());

        $allergy->removeReservation($reservation);
        $this->assertEmpty($allergy->getReservations());
    }

    public function testAddGetRemoveUser(): void
    {
        $allergy = new Allergy();
        $user = new User();
        
        $this->assertEmpty($allergy->getUsers());

        $allergy->addUser($user);
        $this->assertContains($user, $allergy->getUsers());

        $allergy->removeUser($user);
        $this->assertEmpty($allergy->getUsers());
    }
}