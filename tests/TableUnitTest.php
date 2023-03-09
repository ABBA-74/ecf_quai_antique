<?php

namespace App\Tests;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\Table;
use PHPUnit\Framework\TestCase;

class TableUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $table = new Table();
        $room = new Room();

        $table->setName('name')
            ->setNumber(1)
            ->setQtyMax(4)
            ->setRoom($room);

        $this->assertTrue($table->getName() === 'name');
        $this->assertTrue($table->getNumber() === 1);
        $this->assertTrue($table->getQtyMax() === 4);
        $this->assertTrue($table->getRoom() === $room);
    }

    public function testIsFalse(): void
    {
        $table = new Table();
        $room = new Room();

        $table->setName('name')
            ->setNumber(1)
            ->setQtyMax(4)
            ->setRoom($room);

        $this->assertFalse($table->getName() === 'false');
        $this->assertFalse($table->getNumber() === 9);
        $this->assertFalse($table->getQtyMax() === 9);
        $this->assertFalse($table->getRoom() === new Room());
    }

    public function testIsEmpty(): void
    {
        $table = new Table();

        $this->assertEmpty($table->getName());
        $this->assertEmpty($table->getNumber());
        $this->assertEmpty($table->getQtyMax());
        $this->assertEmpty($table->getRoom());
    }

    public function testAddGetRemoveReservation(): void
    {
        $table = new Table();
        $reservation = new Reservation();
        
        $this->assertEmpty($table->getReservations());

        $table->addReservation($reservation);
        $this->assertContains($reservation, $table->getReservations());

        $table->removeReservation($reservation);
        $this->assertEmpty($table->getReservations());
    }
}
