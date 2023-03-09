<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\MenuFormula;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MenuFormulaFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $sluggerInterface)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $menuNames = [
            'Menu du jour',
            'Menu pour enfant',
            'Menu gastronomique',
            'Menu du terroir',
            'Menu découverte',
            'Menu végétarien'
        ];
        $formulaNames = [
            [
                'name' => 'Formule gourmande',
                'description' => 'entrée + plat + dessert'
            ],
            [
                'name' => 'Formule express',
                'description' => 'plat + dessert + café'
            ],
            [
                'name' => 'Formule équilibrée',
                'description' => 'entrée + plat + boisson'
            ],
            [
                'name' => 'Formule traditionnelle',
                'description' => 'plat + fromage + dessert'
            ],
            [
                'name' => 'Formule légère',
                'description' => 'entrée + salade composée'
            ],
            [
                'name' => 'Formule rapide',
                'description' => 'soupe + sandwich + boisson'
            ]
        ];

        for ($i = 0; $i < 12 ; $i++) { 
            $menuFormula = new MenuFormula();

            // menu
            if ($i < 6) {
                $menuFormula->setName($menuNames[$i])
                    ->setDescription($faker->unique()->sentence(6))
                    ->setPrice($faker->randomFloat(1,30,50))
                    ->setSlug($this->sluggerInterface->slug($menuFormula->getName())->lower())
                    ->setIsMenu(true)
                    ->addProduct($this->getReference('mainCourse_'.$faker->numberBetween(0, 10)))
                    ->addProduct($this->getReference('dessert_'.$faker->numberBetween(0, 6)))
                    ->addProduct($this->getReference('starter_'.$faker->numberBetween(0, 4)));
            } else {
            // formula
                $menuFormula->setName($formulaNames[$i - 6]['name'])
                    ->setDescription($formulaNames[$i - 6]['description'])
                    ->setPrice($faker->randomFloat(1,20,30))
                    ->setSlug($this->sluggerInterface->slug($menuFormula->getName())->lower())
                    ->setIsMenu(false);
            }
            $manager->persist($menuFormula);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}