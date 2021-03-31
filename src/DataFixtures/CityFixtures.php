<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public const FIRST_CITY = 'FIRST_CITY';

    public function load(ObjectManager $manager)
    {

        for($i=1;$i<=20;$i++){
            $city = new City();
            $cpo = rand(0,99999);
            $nom = 'Ville'.rand(0,30).'sur-mer';
            $city->setName($nom);
            $city->setPostcode($cpo);
            $manager->persist($city);
        }
        $manager->flush();
        $this->setReference(self::FIRST_CITY,$city);
    }
}
