<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampusFixtures extends Fixture
{
    public const FIRST_CAMPUS = 'FIRST_CAMPUS';


    public function load(ObjectManager $manager)
    {
        for ($i=1;$i<=10;$i++){
            $campus = new Campus();
            $name = 'Ecole de '.rand(0,30). 'de la ville ' . rand(20,30);
            $campus->setName($name);
            $manager->persist($campus);
        }

        $manager->flush();
        $this->setReference(self::FIRST_CAMPUS,$campus);
    }
}
