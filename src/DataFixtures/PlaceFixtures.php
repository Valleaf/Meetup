<?php

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaceFixtures extends Fixture implements DependentFixtureInterface
{
    public const FIRST_PLACE = 'FIRST_PLACE';

    public function load(ObjectManager $manager)
    {
        for ($i=1;$i<=40;$i++){
            $place = new Place();
            $name = 'Cafe'.rand(0,250).' De la rue ' . rand(0,20);
            $address = rand(0,99).' rue de ' . rand(30,70);
            $long = rand(-10,300);
            $lat = rand(900,1500);
            $city = $this->getReference(CityFixtures::FIRST_CITY);

            $place->setName($name)
                ->setAdress($address)
                ->setLatitude($lat)
                ->setLongitude($long)
                ->setCity($city);
            $manager->persist($place);
        }

        $manager->flush();
        $this->setReference(self::FIRST_PLACE,$place);
    }

    public function getDependencies()
    {
        return [CityFixtures::class];
    }
}
