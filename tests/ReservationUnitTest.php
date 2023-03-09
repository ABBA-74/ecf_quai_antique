<?php

namespace App\Tests;

use App\Entity\Allergy;
use App\Entity\Reservation;
use App\Entity\Table;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class ReservationUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $reservation = new Reservation();
        $date1 = new \DateTimeImmutable();
        $date2 = new \DateTimeImmutable();
        $user = new User();
        
        $reservation->setStartDate($date1)
            ->setEndDate($date2)
            ->setQtyGuest(2)
            ->setDescription('description')
            ->setIsConfirmed(true)
            ->setUser($user);

        $this->assertTrue($reservation->getStartDate() === $date1);
        $this->assertTrue($reservation->getEndDate() === $date2);
        $this->assertTrue($reservation->getQtyGuest() === 2);
        $this->assertTrue($reservation->getDescription() === 'description');
        $this->assertTrue($reservation->getIsConfirmed() === true);
        $this->assertTrue($reservation->getUser() === $user);
    }

    public function testIsFalse(): void
    {
        $reservation = new Reservation();
        $date1 = new \DateTimeImmutable();
        $date2 = new \DateTimeImmutable();
        $user = new User();

        $reservation->setStartDate($date1)
            ->setEndDate($date2)
            ->setQtyGuest(2)
            ->setDescription('description')
            ->setIsConfirmed(true)
            ->setUser($user);

        $this->assertFalse($reservation->getStartDate() === new \DateTimeImmutable());
        $this->assertFalse($reservation->getEndDate() ===  new \DateTimeImmutable());
        $this->assertFalse($reservation->getQtyGuest() === 9);
        $this->assertFalse($reservation->getDescription() === 'false');
        $this->assertFalse($reservation->getIsConfirmed() === false);
        $this->assertFalse($reservation->getUser() === new User());
    }

    public function testIsEmpty(): void
    {
        $reservation = new Reservation();

        $this->assertEmpty($reservation->getStartDate());
        $this->assertEmpty($reservation->getEndDate());
        $this->assertEmpty($reservation->getQtyGuest());
        $this->assertEmpty($reservation->getDescription());
        $this->assertEmpty($reservation->getIsConfirmed());
        $this->assertEmpty($reservation->getUser());
    }

    public function testAddGetRemoveTable(): void
    {
        $reservation = new Reservation();
        $table = new Table();
        
        $this->assertEmpty($reservation->getNoTable());

        $reservation->addNoTable($table);
        $this->assertContains($table, $reservation->getNoTable());

        $reservation->removeNoTable($table);
        $this->assertEmpty($reservation->getNoTable());
    }

    public function testAddGetRemoveAllergy(): void
    {
        $reservation = new Reservation();
        $allergy = new Allergy();
        
        $this->assertEmpty($reservation->getAllergy());

        $reservation->addAllergy($allergy);
        $this->assertContains($allergy, $reservation->getAllergy());

        $reservation->removeAllergy($allergy);
        $this->assertEmpty($reservation->getAllergy());
    }
}