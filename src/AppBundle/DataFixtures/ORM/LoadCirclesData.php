<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Circle;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Faker\Factory as FakerFactory;
use Faker\Generator;
use Doctrine\Bundle\FixturesBundle\Fixture;


class LoadCirclesData extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    const REFERENCE_PREFIX = 'app_circle_';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Generator
     */
    private $faker;

    
    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->faker = FakerFactory::create('ru_RU');

        foreach (self::getCirclesDate() as $name => $circleData) {
            $circle = new Circle();
            /** @var User $user */
            $user = $this->getReference(LoadUsersData::REFERENCE_PREFIX . $circleData["userNumber"]);

            $circle->setName($name)
                ->setCountLayer(rand(2,6))
                ->setUser($user);

            $manager->persist($circle);

            if ($this->referenceRepository) {
                $this->addReference(self::REFERENCE_PREFIX . $name, $circle);
            }

            $manager->flush();
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }

    public static function getCirclesDate()
    {
        $arData = [
            "Circle1User0" =>[
                "countSectors" => 4,
                "userNumber" => 0,
                "circleNumber" => 1,
            ],
            "Circle2User0" =>[
                "countSectors" => 2,
                "userNumber" => 0,
                "circleNumber" => 2,
            ],
            "Circle3User0" =>[
                "countSectors" => 3,
                "userNumber" => 0,
                "circleNumber" => 3,
            ],
            "Circle4User0" =>[
                "countSectors" => 4,
                "userNumber" => 0,
                "circleNumber" => 4,
            ],
            "Circle1User1" =>[
                "countSectors" => 4,
                "userNumber" => 1,
                "circleNumber" => 1,
            ],
            "Circle2User1" =>[
                "countSectors" => 2,
                "userNumber" => 1,
                "circleNumber" => 2,
            ],
            "Circle3User1" =>[
                "countSectors" => 3,
                "userNumber" => 1,
                "circleNumber" => 3,
            ],
            "Circle4User1" =>[
                "countSectors" => 4,
                "userNumber" => 1,
                "circleNumber" => 4,
            ],
            "Circle1User2" =>[
                "countSectors" => 4,
                "userNumber" => 2,
                "circleNumber" => 1,
            ],
            "Circle2User2" =>[
                "countSectors" => 2,
                "userNumber" => 2,
                "circleNumber" => 2,
            ],
            "Circle3User2" =>[
                "countSectors" => 3,
                "userNumber" => 2,
                "circleNumber" => 3,
            ],
            "Circle1User3" =>[
                "countSectors" => 4,
                "userNumber" => 3,
                "circleNumber" => 1,
            ],
            "Circle2User3" =>[
                "countSectors" => 2,
                "userNumber" => 3,
                "circleNumber" => 2,
            ],
            "Circle3User3" =>[
                "countSectors" => 3,
                "userNumber" => 3,
                "circleNumber" => 3,
            ],
            "Circle4User3" =>[
                "countSectors" => 4,
                "userNumber" => 3,
                "circleNumber" => 4,
            ],
            "Circle5User3" =>[
                "countSectors" => 5,
                "userNumber" => 3,
                "circleNumber" => 5,
            ],
            "Circle1User4" =>[
                "countSectors" => 4,
                "userNumber" => 4,
                "circleNumber" => 1,
            ],
            "Circle2User4" =>[
                "countSectors" => 2,
                "userNumber" => 4,
                "circleNumber" => 2,
            ],
        ];
        return $arData;
    }

    public static function getCountSecors()
    {
        $countCategories=0;
        foreach (self::getCirclesDate() as $index => $item) {
            $countCategories += $item["countSectors"];
        }
        return $countCategories;
    }
}