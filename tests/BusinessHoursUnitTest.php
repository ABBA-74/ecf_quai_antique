<?php

namespace App\Tests;

use App\Entity\BusinessHours;
use App\Entity\Restaurant;
use PHPUnit\Framework\TestCase;

class BusinessHoursUnitTest extends TestCase
{
    public function testIsTrue(): void
    {
        $businessHours = new BusinessHours();
        $time = new \DateTime();
        $restaurant = new Restaurant();

        $businessHours->setDay('monday')
            ->setOpeningHourLunch($time)
            ->setClosingHourLunch($time)
            ->setOpeningHourDiner($time)
            ->setClosingHourDiner($time)
            ->setRestaurant($restaurant);

        $this->assertTrue($businessHours->getDay() === 'monday');
        $this->assertTrue($businessHours->getOpeningHourLunch() === $time);
        $this->assertTrue($businessHours->getClosingHourLunch() === $time);
        $this->assertTrue($businessHours->getOpeningHourDiner() === $time);
        $this->assertTrue($businessHours->getClosingHourDiner() === $time);
        $this->assertTrue($businessHours->getRestaurant() === $restaurant);
    }

    public function testIsFalse(): void
    {
        $businessHours = new BusinessHours();
        $time = new \DateTime();
        $restaurant = new Restaurant();

        $businessHours->setDay('monday')
            ->setOpeningHourLunch($time)
            ->setClosingHourLunch($time)
            ->setOpeningHourDiner($time)
            ->setClosingHourDiner($time)
            ->setRestaurant($restaurant);

        $this->assertFalse($businessHours->getDay() === 'sunday');
        $this->assertFalse($businessHours->getOpeningHourLunch() === new \DateTime());
        $this->assertFalse($businessHours->getClosingHourLunch() === new \DateTime());
        $this->assertFalse($businessHours->getOpeningHourDiner() === new \DateTime());
        $this->assertFalse($businessHours->getClosingHourDiner() === new \DateTime());
        $this->assertFalse($businessHours->getRestaurant() === new Restaurant());
    }

    public function testIsEmpty(): void
    {
        $businessHours = new BusinessHours();

        $this->assertEmpty($businessHours->getDay());
        $this->assertEmpty($businessHours->getOpeningHourLunch());
        $this->assertEmpty($businessHours->getClosingHourLunch());
        $this->assertEmpty($businessHours->getOpeningHourDiner());
        $this->assertEmpty($businessHours->getClosingHourDiner());
        $this->assertEmpty($businessHours->getRestaurant());
    }
}