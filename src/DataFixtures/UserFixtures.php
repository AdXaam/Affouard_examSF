<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
$accountRh = new User();
$accountRh->setFirstname('Human');
$accountRh->setLastname('Booster');
$accountRh->setEmail('rh@humanbooster.com');
$encodePassword = $this->hasher->hashPassword($accountRh,"rh123@");
$accountRh->setPassword($encodePassword);
$accountRh->setRoles(['ROLE_RH']);
$accountRh->setSector('RH');
$accountRh->setContract('CDI');

        $manager->persist($accountRh);
        $manager->flush();
    }
}
