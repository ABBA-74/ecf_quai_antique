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
            [
                'name' => 'Menu du Terroir',
                'description' => 'Une expérience culinaire savoyarde ludique, délicieuse et adaptée aux enfants, pour les petits gourmets curieux.'
            ],
            [
                'name' => 'Menu Festin des Cimes',
                'description' => 'Envolez-vous vers de sommets gastronomiques, une expérience culinaire d\'exception inspirée par les trésors de la Savoie.'
            ],
            [
                'name' => 'Menu Délices du Chef',
                'description' => 'Découvrez notre Menu Délices du Chef, une expérience culinaire savoyarde enchantée, avec des créations exquises et raffinées.'
            ]
        ];
        $formulaNames = [
            [
                'name' => 'Formule express',
                'description' => 'Plat + Dessert + Café'
            ],
            [
                'name' => 'Formule légère',
                'description' => 'Entrée + Salade composée'
            ],
            [
                'name' => 'Formule équilibrée',
                'description' => 'Entrée + Plat + Boisson'
            ],
        ];

        for ($i = 0; $i < 6 ; $i++) { 
            $menuFormula = new MenuFormula();

            // menu
            if ($i < 3) {
                $menuFormula->setName($menuNames[$i]['name'])
                    ->setDescription($menuNames[$i]['description'])
                    ->setPrice($faker->randomFloat(1,30,50))
                    ->setSlug($this->sluggerInterface->slug($menuFormula->getName())->lower())
                    ->setIsMenu(true)
                    ->addProduct($this->getReference('starter_'.$faker->numberBetween(0, 4)))
                    ->addProduct($this->getReference('mainCourse_'.$faker->numberBetween(0, 10)))
                    ->addProduct($this->getReference('dessert_'.$faker->numberBetween(0, 6)));
            } else {
            // formula
                $menuFormula->setName($formulaNames[$i - 3]['name'])
                    ->setDescription($formulaNames[$i - 3]['description'])
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