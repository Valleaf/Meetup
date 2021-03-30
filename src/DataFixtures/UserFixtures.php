<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }


    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $int = rand(0,200000);
            $user->setUsername('User'.$int);
            $user->setFirstName('Val'.$int);
            $user->setLastName('TR'.$int);
            $user->setEmail('Val'.$int);
            $user->setPhone($int);
            $user->setIsActive(true);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'the_new_password'
            ));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
