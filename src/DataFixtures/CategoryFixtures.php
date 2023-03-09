<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    public function __construct(private SluggerInterface $sluggerInterface) { }

    public function load(ObjectManager $manager): void
    {
        $categoryNames = ['entrée', 'soupe','plat', 'salade composée', 'sandwitch','fromage', 'boisson','dessert', 'café'];
        
        for ($i = 0; $i < count($categoryNames); $i++) { 
            $category = new Category();
            
            $category->setName($categoryNames[$i])
                ->setSlug($this->sluggerInterface->slug($category->getName())->lower());
            
            $this->addReference('category_'.$i, $category);

            $manager->persist($category);
        }
        $manager->flush();
    }
}