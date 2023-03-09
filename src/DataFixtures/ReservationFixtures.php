<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Reservation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $mins = [0, 15, 30, 45];
        $hours = [12, 13, 19, 20, 21];
        
        for ($i = 0; $i < 20; $i++) { 
            $reservation = new Reservation();
            $member = $this->getReference('member_'.$faker->numberBetween(1,8));

            $date = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 month', '-1 week'))
                ->modify($hours[rand(0,4)].':'.$mins[rand(0,3)].':00');

            $reservation->setStartDate($date)
                ->setEndDate($date->modify('+1 hour'))
                ->setQtyGuest($faker->numberBetween(1,6))
                ->setDescription($faker->sentence(9))
                ->setIsConfirmed($faker->boolean())
                ->setUser($member)
                ->setName($member->getLastname())
                ->setEmail($member->getEmail());
            
            $qtyGuest = $reservation->getQtyGuest();
            switch (true) {
                case $qtyGuest <= 2:
                    $reservation->addNoTable($this->getReference('table_'.$faker->randomElement([1,2,3,9,10,11])));
                    break;
                case $qtyGuest <= 4:
                    $reservation->addNoTable($this->getReference('table_'.$faker->randomElement([4,5,6,12,13,14])));
                    break;
                case $qtyGuest <= 6:
                    $reservation->addNoTable($this->getReference('table_'.$faker->randomElement([7,8,15,16])));
                    break;
            }
            for ($j = 0; $j < mt_rand(0,3); $j++) { 
                $reservation->addAllergy($this->getReference('allergy_'.$faker->numberBetween(0,12)));
            }
            $manager->persist($reservation);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AllergyFixtures::class,
            TableFixtures::class,
            UserFixtures::class,
        ];
    }
}