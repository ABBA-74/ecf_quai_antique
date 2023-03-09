<?php

namespace App\DataFixtures;

use App\Entity\BusinessHours;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BusinessHoursFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $dayWeek = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

        for ($i = 0; $i < 7; $i++) {
            $businessHours = new BusinessHours();
            $time1 = new \DateTime();
            $time2 = new \DateTime();
            $time3 = new \DateTime();
            $time4 = new \DateTime();
            
            $businessHours->setDay($dayWeek[$i])
                ->setOpeningHourLunch($time1->setTime(12, 0))
                ->setClosingHourLunch($time2->setTime(14, 0))
                ->setOpeningHourDiner($time3->setTime(19, 0))
                ->setClosingHourDiner($time4->setTime(22, 0))
                ->setRestaurant($this->getReference('restaurant'));

            $manager->persist($businessHours);
        };
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RestaurantFixtures::class,
        ];
    }
}