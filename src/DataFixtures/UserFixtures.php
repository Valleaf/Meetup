<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public const FIRST_USER = 'first_user';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }



    public function load(ObjectManager $manager)
    {
        $user = new User();
        $int = rand(0,200000);
        $user->setUsername('User');
        $user->setFirstName('Val');
        $user->setLastName('TR');
        $user->setEmail('Val@gmail.com');
        $user->setPhone($int);
        $user->setIsActive(true);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'tototo'
        ));

        $manager->persist($user);

        for ($i = 1; $i <= 30; $i++) {
            $user = new User();
            $int = rand(0,200000);
            $user->setUsername('User'.$int);
            $user->setFirstName('Val'.$int);
            $user->setLastName('TR'.$int);
            $user->setEmail('Val'.$int.'@gmail.com');
            $user->setPhone($int);
            $user->setIsActive(true);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'tototo'
            ));
            $manager->persist($user);
        }
        $manager->flush();
        $this->setReference(self::FIRST_USER,$user);
    }
}
