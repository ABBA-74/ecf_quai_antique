<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Table;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TableFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $table = new Table();

        for ($i = 1; $i <= 2 ; $i++) { 
            for ($j = 1; $j < 9 ; $j++) { 
                $table = new Table();
                $noTable = $j + ($i - 1) * 8;
                $table->setName($faker->unique()->sentence(2))
                ->setNumber($noTable)
                ->setRoom($this->getReference('room_' . $i));

                switch (true) {
                    case $j < 4:
                        $table->setQtyMax(2);
                        break;
                    case $j < 7:
                        $table->setQtyMax(4);
                        break;
                    case $j < 9:
                        $table->setQtyMax(6);
                        break;
                }
                $this->addReference('table_'.$noTable, $table);
                $manager->persist($table);
            }
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            RoomFixtures::class,
        ];
    }
}