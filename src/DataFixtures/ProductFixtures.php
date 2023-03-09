<?php

namespace App\DataFixtures;

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
        $starter = [
            [
                'name' => 'Une terrine de volaille aux champignons',
                'description' => 'Une terrine savoureuse de volaille et de champignons, relevée d\'une touche de porto blanc et de cerfeuil frais.'
            ],
            [
                'name' => 'Une salade de pommes de terre farcies',
                'description' => 'Des pommes de terre cuites au four et garnies de fromage frais, de lardons et de ciboulette, servies sur un lit de salade verte assaisonnée.'
            ],
            [
                'name' => 'Une salade de chèvre chaud',
                'description' => 'Des tranches de pain grillé surmontées de rondelles de fromage de chèvre et passées au four, accompagnées d\'une salade composée de tomates, d\'oignons rouges et de noix.'
            ],
            [
                'name' => 'Un millefeuille de la mer',
                'description' => 'Une superposition de feuilles de brick croustillantes et d\'une préparation à base de saumon fumé, d\'épinards et de crème fraîche, nappée d\'une sauce béchamel au citron.'
            ],
            [
                'name' => 'Une omelette aux champignons de Paris',
                'description' => 'Une omelette moelleuse aux œufs battus avec du lait et du persil, garnie de champignons émincés et revenus à la poêle avec du beurre et du sel.'
            ],
        ];

        $soup = [ 
            [
                'name' => 'Soupe savoyarde',
                'description' => 'Pommes de terre, poireaux, oignons, bouillon de volaille, fromage à raclette, croûtons, ail, jambon cru.',
            ],
            [
                'name' => 'Soupe aux diots',
                'description' => 'Diots (saucisses savoyardes au vin blanc), chou vert, pommes de terre, eau salée, pain grillé.'
            ],
            [
                'name' => 'Soupe à la tomme',
                'description' => 'Tomme fraîche coupée en petits morceaux lait eau sel poivre noir moulu noix de muscade râpée pain rassis frotté à l\'ail.'
            ],
            [
                'name' => 'Velouté de potiron',
                'description' => 'Potiron, oignons, bouillon de légumes, crème fraîche, sel, poivre noir, noix de muscade, cerfeuil.'
            ],
            [
                'name' => 'Velouté de carottes',
                'description' => 'Carottes, pommes de terre, oignons, bouillon de volaille, crème fraîche, sel, poivre noir, cumin, coriandre.'
            ],
        ];

        $burger = [
            [
                'name' => 'Le Mont-Blanc',
                'description' => 'Un burger avec du pain brioché, du steak haché, du fromage à raclette, de la salade verte, des oignons caramélisés et de la sauce béchamel.'
            ],
            [
                'name' => 'Le Savoyard',
                'description' => 'Un burger avec du pain aux céréales, du steak haché, du reblochon, du jambon cru, de la roquette et de la confiture de myrtilles.'
            ],
            [
                'name' => 'Le Tartiflette',
                'description' => 'Un burger avec du pain au sésame, du steak haché, des pommes de terre sautées, du lard fumé, du fromage à tartiflette et de la crème fraîche.'
            ],
            [
                'name' => 'Le Fondue',
                'description' => 'Un burger avec du pain à l\'ail, du steak haché pané au fromage fondu (emmental et comté), des cornichons aigres-doux et de la moutarde à l\'ancienne.'
            ],
            [
                'name' => 'Le Raclette',
                'description' => 'Un burger avec du pain au maïs, deux steaks hachés superposés avec une tranche de fromage à raclette entre eux, des tomates séchées et de la sauce barbecue.'
            ]
        ];

        $mainCourse = [
            [
                'name' => 'Berthoud',
                'description' => 'Une spécialité savoyarde à base de fromage d\'Abondance fondu au vin blanc et servi avec des pommes de terre et du pain.'
            ],
            [
                'name' => 'Croziflette savoyarde',
                'description' => 'Une variante de la tartiflette à base de crozets, des petites pâtes carrées typiques de la Savoie, gratinées avec du reblochon et des lardons.'
            ],
            [
                'name' => 'Dio au vin blanc',
                'description' => 'Un plat traditionnel du Bugey à base de pommes de terre cuites dans du vin blanc avec des oignons, du beurre et du persil.'
            ],
            [
                'name' => 'Farcement',
                'description' => 'Un gâteau salé à base de pommes de terre râpées, de lardons, d\'oignons, d\'œufs et de crème, parfumé à la muscade et cuit dans un moule à charlotte.'
            ],
            [
                'name' => 'Fondue savoyarde',
                'description' => 'Un plat convivial à base de fromages fondus (comté, beaufort, emmental) dans du vin blanc et dégustés avec des morceaux de pain trempés dans le caquelon.'
            ],
            [
                'name' => 'Mafetan',
                'description' => 'Une soupe épaisse à base d\'orge mondé cuit dans un bouillon aromatisé avec des herbes et des légumes (carottes, poireaux, céleri).'
            ],
            [
                'name' => 'Pela reblochon',
                'description' => 'Une poêlée savoyarde à base de pommes de terre sautées avec des oignons et du reblochon fondu.'
            ],
            [
                'name' => 'Polenta',
                'description' => 'Une semoule de maïs cuite dans de l\'eau, du bouillon ou du lait, qui peut être servie crémeuse ou grillée. Un accompagnement idéal pour les viandes en sauce ou les légumes.'
            ],
            [
                'name' => 'Raclette',
                'description' => 'Un plat d\'origine suisse à base de fromage à raclette fondu sur un appareil électrique et dégusté avec des pommes de terre, de la charcuterie et des cornichons.'
            ],
            [
                'name' => 'Truffade',
                'description' => 'Une spécialité auvergnate à base de pommes de terre sautées avec du lard et du fromage de cantal fondu. Un plat réconfortant et généreux.'
            ],
            [
                'name' =>  'Tartiflette',
                'description' => 'Une gratin savoyard à base de pommes de terre, d\'oignons, de lardons et de reblochon. Un plat gourmand et convivial.'
            ]
        ];

        $dessert = [
            [
                'name' => 'Gateau chocolat',
                'description' => 'Un dessert irrésistible à base de chocolat fondu et de beurre, avec une touche de café ou de vanille. Une texture fondante et un goût intense qui raviront les amateurs de chocolat.'
            ],
            [
                'name' => 'Tartelette aux pommes',
                'description' => 'Une pâte brisée croustillante garnie de compote de pommes et de fines lamelles de pommes caramélisées. Un dessert simple et savoureux qui met en valeur le fruit.'
            ],
            [
                'name' => 'Tartelette aux fraises',
                'description' => 'Une pâte sablée croustillante garnie d\'une crème pâtissière onctueuse et de fraises fraîches coupées en forme de fleurs. Un dessert léger et gourmand à la fois.'
            ],
            [
                'name' => 'Tiramisu',
                'description' => 'Un entremet italien à base de biscuits à la cuillère imbibés de café et de liqueur, recouverts d\'une crème au mascarpone et saupoudrés de cacao amer. Un délice fondant et parfumé.'
            ],
            [
                'name' => 'Café gourmant',
                'description' => 'Un assortiment de mini-desserts accompagné d\'un café expresso. Idéal pour terminer le repas sur une note sucrée sans trop se remplir l\'estomac.'
            ],
            [
                'name' => 'Crème brûlée au café et aux groseilles',
                'description' => ' Une crème anglaise aromatisée au café et nappée d\'une fine couche de sucre caramélisé. Des groseilles acidulées viennent apporter du contraste et du croquant à ce dessert crémeux.'
            ],
            [
                'name' => 'Flan aux oeufs',
                'description' => 'Un dessert traditionnel à base d\'oeufs, de lait et de sucre, cuit au four dans un moule au bain-marie. Une texture fondante et un goût doux qui rappellent l\'enfance.'
            ]
        ];

        $qtyStarter = count($starter);
        $qtySoup = count($soup);
        $qtyBurger = count($burger);
        $qtyMainCourse = count($mainCourse);
        $qtyDessert = count($dessert);
        // add products : 5x starters / 3x soups / 5x burgers / 11x main courses / 7x desserts
        $productsDesc = [...$starter, ...$soup, ...$burger, ...$mainCourse, ...$dessert];
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
                //starter
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
                case $i < count($starter) + count($soup) + count($burger) + count($mainCourse) + count($dessert):
                    $product->setCategory($this->getReference('category_7'))
                        ->setPrice($faker->randomFloat(1,6,15));
                    $this->addReference('dessert_'.$i - ($qtyStarter + $qtySoup + $qtyBurger + $qtyMainCourse), $product);
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