<?php

namespace App\DataFixtures;

use App\Entity\Meeting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\This;
use function Sodium\add;

class MeetingsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1;$i<=30;$i++) {
            $meet = new Meeting();
            $int = rand(0,20520);
            $month = rand(1,12);
            $day = rand(1,28);
            $length = rand(60,360);
            $date = new \DateTime('2021-'.$month.'-'.$day);
            $dateLater = new \DateTime('2021-'.$month.'-'.$day);
            $dateLater->modify('-1 day');
            $organizer = $this->getReference(UserFixtures::FIRST_USER);


            $meet->setName('Reunion'.$int)
                 ->setTimeStarting($date)
                ->setLength($length)
                ->setRegisterUntil($dateLater)
                ->setMaxParticipants(10)
                ->setInformation('lorem ipsum blablabduudkjsadhasd blablabduudkjsadhasdblablabduudkjsadhasd blablabduudkjsadhasd')
                ->setState('Actif')
                ->setOrganisedBy($organizer);
            $manager->persist($meet);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
