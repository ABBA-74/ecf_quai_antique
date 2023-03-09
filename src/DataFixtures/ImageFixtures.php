<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Image;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $sluggerInterface) { }
    
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $photos = [
            'berthoud.webp', 'croziflette-savoyarde.jpg', 'dio-au-vin-blanc.jpg', 'farcement.webp', 
            'fondue-savoyarde.jpg', 'mafetan.jpg', 'pela-reblochon.jpg', 'polenta.jpg', 'raclette.png',
            'truffade.jpg', 'tartiflette.jpg', 'gateau-chocolat.jpeg','tartelette-aux-pommes.png',
            'tartelette-aux-fraises.png', 'tiramisu.jpg','cafe-gourmant.webp', 
            'creme-brulee-au-cafe-et-aux-groseilles.webp', 'flan-aux-oeufs.jpeg',
        ];

        for ($i = 0; $i < count($photos); $i++) { 
            $image = new Image();

            $imageNameTmp = explode(".", $photos[$i])[0];
            $image->setName(str_replace("-", " ", $imageNameTmp))
                ->setDescription($faker->sentence(9))
                ->setFilename($photos[$i])
                ->setSlug($this->sluggerInterface->slug($image->getName())->lower());
                
            if ($i < 11) {
                $image->setProduct($this->getReference('mainCourse_' . $i));
            } else {
                $image->setProduct($this->getReference('dessert_' . $i - 11));
            }

            $this->addReference('image_'.$i, $image);

            $manager->persist($image);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class
        ];
    }
}
