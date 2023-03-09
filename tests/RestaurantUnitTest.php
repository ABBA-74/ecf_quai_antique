<?php

namespace App\Tests;

use App\Entity\BusinessHours;
use App\Entity\Restaurant;
use PHPUnit\Framework\TestCase;

class RestaurantUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $restaurant = new Restaurant();

        $restaurant->setName('name')
            ->setDescription('description')
            ->setAddress('address')
            ->setPostalCode('11111')
            ->setCity('city')
            ->setPhone('0101010101')
            ->setEmail('test@test.com')
            ->setTimeSlot(60);
        
        $this->assertTrue($restaurant->getName() === 'name');
        $this->assertTrue($restaurant->getDescription() === 'description');
        $this->assertTrue($restaurant->getAddress() === 'address');
        $this->assertTrue($restaurant->getPostalCode() === '11111');
        $this->assertTrue($restaurant->getCity() === 'city');
        $this->assertTrue($restaurant->getPhone() === '0101010101');
        $this->assertTrue($restaurant->getEmail() === 'test@test.com');
        $this->assertTrue($restaurant->getTimeSlot() === 60);

    }

    public function testIsFalse(): void
    {
        $restaurant = new Restaurant();

        $restaurant->setName('name')
            ->setDescription('description')
            ->setAddress('address')
            ->setPostalCode('11111')
            ->setCity('city')
            ->setPhone('0101010101')
            ->setEmail('test@test.com')
            ->setTimeSlot(60);
        
        $this->assertFalse($restaurant->getName() === 'false');
        $this->assertFalse($restaurant->getDescription() === 'false');
        $this->assertFalse($restaurant->getAddress() === 'false');
        $this->assertFalse($restaurant->getPostalCode() === '99999');
        $this->assertFalse($restaurant->getCity() === 'false');
        $this->assertFalse($restaurant->getPhone() === '0909090909');
        $this->assertFalse($restaurant->getEmail() === 'false@test.com');
        $this->assertFalse($restaurant->getTimeSlot() === 99);

    }

    public function testIsEmpty()
    {
        $restaurant = new Restaurant();

        $this->assertEmpty($restaurant->getName());
        $this->assertEmpty($restaurant->getDescription());
        $this->assertEmpty($restaurant->getAddress());
        $this->assertEmpty($restaurant->getPostalCode());
        $this->assertEmpty($restaurant->getCity());
        $this->assertEmpty($restaurant->getPhone());
        $this->assertEmpty($restaurant->getEmail());
        $this->assertEmpty($restaurant->getTimeSlot());
    }

    public function testAddGetRemoveBusinessHours(): void
    {
        $restaurant = new Restaurant();
        $businessHours = new BusinessHours();
        
        $this->assertEmpty($restaurant->getBusinessHours());

        $restaurant->addBusinessHour($businessHours);
        $this->assertContains($businessHours, $restaurant->getBusinessHours());

        $restaurant->removeBusinessHour($businessHours);
        $this->assertEmpty($restaurant->getBusinessHours());
    }
}