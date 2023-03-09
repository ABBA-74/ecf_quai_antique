<?php

namespace App\Tests;

use App\Entity\Allergy;
use App\Entity\Reservation;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $user = new User();
        $date = new \DateTimeImmutable();

        $user->setFirstname('firstname')
            ->setLastname('lastname')
            ->setPhone('0101010101')
            ->setEmail('test@test.com')
            ->setPassword('password')
            ->setIsActive(true)
            ->setRoles(['ROLE_TEST'])
            ->setSlug('test')
            ->setCreatedAt($date)
            ->setUpdatedAt($date);

        $this->assertTrue($user->getFirstname() === 'firstname');
        $this->assertTrue($user->getLastname() === 'lastname');
        $this->assertTrue($user->getPhone() === '0101010101');
        $this->assertTrue($user->getEmail() === 'test@test.com');
        $this->assertTrue($user->getPassword() ==='password');
        $this->assertTrue($user->getIsActive() === true);
        $this->assertTrue($user->getRoles() === ['ROLE_TEST', 'ROLE_USER']);
        $this->assertTrue($user->getSlug() === 'test');
        $this->assertTrue($user->getCreatedAt() === $date);
        $this->assertTrue($user->getUpdatedAt() === $date);
    }

    public function testIsFalse(): void
    {
        $user = new User();
        $date = new \DateTimeImmutable();

        $user->setFirstname('firstname')
            ->setLastname('lastname')
            ->setPhone('0101010101')
            ->setEmail('test@test.com')
            ->setPassword('password')
            ->setIsActive(true)
            ->setRoles(['ROLE_TEST'])
            ->setSlug('test')
            ->setCreatedAt($date)
            ->setUpdatedAt($date);

            $this->assertFalse($user->getFirstname() === 'false');
            $this->assertFalse($user->getLastname() === 'false');
            $this->assertFalse($user->getPhone() === '0909090909');
            $this->assertFalse($user->getEmail() === 'false@false.com');
            $this->assertFalse($user->getPassword() === 'false');
            $this->assertFalse($user->getIsActive() === false);
            $this->assertFalse($user->getRoles() === ['ROLE_FALSE']);
            $this->assertFalse($user->getSlug() === 'false');
            $this->assertFalse($user->getCreatedAt() === null);
            $this->assertFalse($user->getUpdatedAt() === null);
    }

    public function testIsEmpty(): void
    {
        $user = new User();

            $this->assertEmpty($user->getFirstname());
            $this->assertEmpty($user->getLastname());
            $this->assertEmpty($user->getPhone());
            $this->assertEmpty($user->getEmail());
            $this->assertEmpty($user->getPassword());
            $this->assertEmpty($user->getIsActive());
            $this->assertEmpty($user->getSlug());
            $this->assertEmpty($user->getUpdatedAt());
    }

    public function testAddGetRemoveReservation(): void
    {
        $user = new User();
        $reservation = new Reservation();

        $this->assertEmpty($user->getReservations());

        $user->addReservation($reservation);
        $this->assertContains($reservation, $user->getReservations());

        $user->removeReservation($reservation);
        $this->assertEmpty($user->getReservations());
    }

    public function testAddGetAllergy(): void
    {
        $user = new User();
        $allergy = new Allergy();

        $this->assertEmpty($user->getAllergy());

        $user->addAllergy($allergy);
        $this->assertContains($allergy, $user->getAllergy());

        $user->removeAllergy($allergy);
        $this->assertEmpty($user->getAllergy());
    }
}
