<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasherInterface,
        private SluggerInterface $sluggerInterface
    ) { }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 10 ; $i++) { 
            $user = new User();

            $user->setFirstname($faker->unique()->firstName())
            ->setLastname($faker->unique()->lastname())
            ->setPhone($faker->regexify('06[0-9]{8}'))
            ->setEmail(
                sprintf('%s.%s@%s',
                $this->sluggerInterface->slug($user->getFirstname())->lower(),
                $this->sluggerInterface->slug($user->getLastname())->lower(),
                $faker->safeEmailDomain()
                )
            )
            ->setIsActive(true)
            ->setSlug($this->sluggerInterface->slug($user->getFirstname())->lower() . 
            '-' . $this->sluggerInterface->slug($user->getLastname())->lower());

            // Creating 2 admins
            if ($i < 3) {
                $intervalDate = $faker->dateTimeBetween('-6 month', '-5 month');
                $user->setPassword($this->userPasswordHasherInterface
                ->hashPassword($user, 'admin'))
                ->setRoles(['ROLE_ADMIN'])
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($intervalDate))
                ->setIsActive(true);
                $this->addReference('admin_' . $i, $user);
            } else {
            // Creating 8 members
                $intervalDate = $faker->dateTimeBetween('-5 month', '-3 day');
                $user->setPassword($this->userPasswordHasherInterface
                ->hashPassword($user, 'member'))
                ->setRoles(['ROLE_MEMBER'])
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($intervalDate))
                ->setIsActive($faker->boolean());
                // member_1 > 8
                $this->addReference('member_' . $i - 2, $user);
                for ($j = 0; $j < mt_rand(0,3); $j++) { 
                    $user->addAllergy($this->getReference('allergy_'.$faker->numberBetween(0, 12)));
                }
            }
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AllergyFixtures::class,
        ];
    }
}