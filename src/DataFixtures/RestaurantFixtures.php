<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RestaurantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $restaurant = new Restaurant();

        $restaurant->setName('Quai Antique')
        ->setDescription('Restaurant gastronomique Savoyard')
        ->setAddress('2 rue de la poste')
        ->setPostalCode('73000')
        ->setCity('Chambery')
        ->setPhone($faker->regexify('0450[0-9]{6}'))
        ->setEmail('contact@quai-antique.fr')
        ->setTimeSlot(60);

        $this->addReference('restaurant', $restaurant);

        $manager->persist($restaurant);
        $manager->flush();
    }
}