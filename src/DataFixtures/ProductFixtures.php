<?php

namespace App\DataFixtures;

use App\Data\DataAperitifs;
use App\Data\DataBurgers;
use App\Data\DataDesserts;
use App\Data\DataDigestifs;
use App\Data\DataMainCourses;
use App\Data\DataSoups;
use App\Data\DataStarters;
use App\Data\DataWines;
use Faker\Factory;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $sluggerInterface)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        // add products : 5x starter / 5x soup / 5x burger / 11x main course / 7x dessert
        $starters = DataStarters::DATA;
        $soups = DataSoups::DATA;
        $burgers = DataBurgers::DATA;
        $mainCourses = DataMainCourses::DATA;
        $desserts = DataDesserts::DATA;
        $aperitifs = DataAperitifs::DATA;
        $wines = DataWines::DATA;
        $digestifs = DataDigestifs::DATA;

        $qtyStarter = count($starters);
        $qtySoup = count($soups);
        $qtyBurger = count($burgers);
        $qtyMainCourse = count($mainCourses);
        $qtyDessert = count($desserts);
        $qtyAperitifs = count($aperitifs);
        $qtyWines = count($wines);
        $qtyDigestifs = count($digestifs);
        // add products : 5x starters / 3x soups / 5x burgers / 11x main courses / 7x desserts / 10 apero / 10 vins / 10 digo
        $productsDesc = [...$starters, ...$soups, ...$burgers, ...$mainCourses, ...$desserts, ...$aperitifs, ...$wines, ...$digestifs];
        for ($i = 0; $i < count($productsDesc); $i++) {
            $product = new Product();

            $product->setName($productsDesc[$i]['name'])
                ->setDescription($productsDesc[$i]['description'])
                ->setIsFavorite($faker->boolean())
                ->setSlug($this->sluggerInterface->slug($productsDesc[$i]['name'])->lower());

            for ($j = 0; $j < rand(0, 3); $j++) { 
                $product->addAllergy( $this->getReference('allergy_'.$faker->numberBetween(0, 12)));
            }
            switch (true) {
                // starter
                case $i < $qtyStarter:
                    $product->setCategory($this->getReference('category_0'))
                        ->setPrice($faker->randomFloat(1,8,15));
                    $this->addReference('starter_'.$i, $product);
                    break;
                // soup
                case $i < $qtyStarter + $qtySoup:
                    $product->setCategory($this->getReference('category_1'))
                    ->setPrice($faker->randomFloat(1,8,12));
                    $this->addReference('soup_'.$i - $qtyStarter, $product);
                break;
                // burger
                case $i < $qtyStarter + $qtySoup + $qtyBurger:
                    $product->setCategory($this->getReference('category_4'))
                        ->setPrice($faker->randomFloat(1,12,18));
                    $this->addReference('burger_'.$i - ($qtyStarter + $qtySoup), $product);
                break;
                // main course
                case $i < $qtyStarter + $qtySoup + $qtyBurger + $qtyMainCourse:
                    $product->setCategory($this->getReference('category_2'))
                        ->setPrice($faker->randomFloat(1,18,25));
                    $this->addReference('mainCourse_'.$i - ($qtyStarter + $qtySoup + $qtyBurger), $product);
                break;
                // dessert
                case $i < $qtyStarter + $qtySoup + $qtyBurger + $qtyMainCourse + $qtyDessert:
                    $product->setCategory($this->getReference('category_7'))
                        ->setPrice($faker->randomFloat(1,6,15));
                    $this->addReference('dessert_'.$i - ($qtyStarter + $qtySoup + $qtyBurger + $qtyMainCourse), $product);
                break;
                // aperitifs
                case $i < $qtyStarter + $qtySoup + $qtyBurger + $qtyMainCourse + $qtyDessert + $qtyAperitifs:
                    $product->setCategory($this->getReference('category_9'))
                        ->setPrice($faker->randomFloat(1,8,12));
                break;
                // vins
                case $i < $qtyStarter + $qtySoup + $qtyBurger + $qtyMainCourse + $qtyDessert + $qtyAperitifs + $qtyWines:
                    $product->setCategory($this->getReference('category_10'))
                        ->setPrice($faker->randomFloat(1,18,28));
                break;
                // disgestifs
                case $i < $qtyStarter + $qtySoup + $qtyBurger + $qtyMainCourse + $qtyDessert + $qtyAperitifs + $qtyWines + $qtyDigestifs:
                    $product->setCategory($this->getReference('category_11'))
                        ->setPrice($faker->randomFloat(1,8,15));
                break;

                default:
                break;
            }
            $manager->persist($product);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AllergyFixtures::class,
            CategoryFixtures::class,
        ];
    }
}