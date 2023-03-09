<?php

namespace App\DataFixtures;

use App\Entity\Allergy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AllergyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $allergyNames = ['Lupin', 'Sulfites', 'Sésame', 'Moutarde', 'Céleri', 'Fruit à Coques', 'Lait', 'Soja', 'Arachides', 'Poissons', 'Oeufs', 'Mollusques - Crustacés', 'Gluten'];

        for ($i = 0; $i < count($allergyNames); $i++) { 
            $allergy = new Allergy();

            $allergy->setName($allergyNames[$i]);

            $this->addReference('allergy_'.$i, $allergy);

            $manager->persist($allergy);
        }
        $manager->flush();
    }
}