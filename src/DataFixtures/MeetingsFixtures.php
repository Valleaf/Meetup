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
            $campus = $this->getReference(CampusFixtures::FIRST_CAMPUS);
            $status = $this->getReference(StateFixtures::FIRST_STATE);
            $place = $this->getReference(PlaceFixtures::FIRST_PLACE);

            $meet->setName('Reunion'.$int)
                 ->setTimeStarting($date)
                ->setLength($length)
                ->setRegisterUntil($dateLater)
                ->setMaxParticipants(10)
                ->setInformation('lorem ipsum blablabduudkjsadhasd blablabduudkjsadhasdblablabduudkjsadhasd blablabduudkjsadhasd')
                ->setCampus($campus)
                ->setPlace($place)
                ->setStatus($status)
                ->setOrganisedBy($organizer);
            $manager->persist($meet);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class,CampusFixtures::class,StateFixtures::class,PlaceFixtures::class];
    }
}
