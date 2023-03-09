<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Room;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RoomFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $roomNames = [
            'Mont Charvin', 
            'Mont Pela',
            'Mont Bellacha',
            'Mont Blanc',
            'Mont Mirantin',
            'Mont Bisanne',
            'Mont Jovet'
        ];

        // 2 restaurant rooms
        for ($i = 1; $i <= 2 ; $i++) { 
            $room = new Room();

            $room->setName($roomNames[$faker->unique()->numberBetween(0,6)])
            ->setDescription($faker->sentence(8))
            ->setRestaurant($this->getReference('restaurant'));

            $this->addReference('room_'.$i, $room);

            $manager->persist($room);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RestaurantFixtures::class,
        ];
    }
}