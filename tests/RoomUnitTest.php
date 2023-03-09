<?php

namespace App\Tests;

use App\Entity\Restaurant;
use App\Entity\Room;
use PHPUnit\Framework\TestCase;

class RoomUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $room = new Room();
        $restaurant = new Restaurant();

        $room->setName('name')
            ->setDescription('description')
            ->setRestaurant($restaurant);
        
        $this->assertTrue($room->getName() === 'name');
        $this->assertTrue($room->getDescription() === 'description');
        $this->assertTrue($room->getRestaurant() === $restaurant);
    }

    public function testIsFalse(): void
    {
        $room = new Room();
        $restaurant = new Restaurant();

        $room->setName('name')
            ->setDescription('description')
            ->setRestaurant($restaurant);
        
        $this->assertFalse($room->getName() === 'false');
        $this->assertFalse($room->getDescription() === 'false');
        $this->assertFalse($room->getRestaurant() === new Restaurant());
    }

    public function testIsEmpty(): void
    {
        $room = new Room();

        $this->assertEmpty($room->getName());
        $this->assertEmpty($room->getDescription());
        $this->assertEmpty($room->getRestaurant());
    }
}
