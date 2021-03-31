<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public const FIRST_STATE = 'FIRST_STATE';

    public function load(ObjectManager $manager)
    {
        $state = new State();
        $state->setLabel('Créée');
        $manager->persist($state);
        $state = new State();
        $state->setLabel('Ouverte');
        $manager->persist($state);
        $state = new State();
        $state->setLabel('Cloturee');
        $manager->persist($state);
        $state = new State();
        $state->setLabel('Activite en cours');
        $manager->persist($state);
        $state = new State();
        $state->setLabel('Passee');
        $manager->persist($state);
        $state = new State();
        $state->setLabel('Annulee');
        $manager->persist($state);
        $manager->flush();
        $this->setReference(self::FIRST_STATE, $state);
    }
}
