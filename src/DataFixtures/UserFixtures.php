<?php

namespace App\DataFixtures;

use App\Entity\GameMaster;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    protected UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; ++$i) {
            $gameMaster = new GameMaster();
            $gameMaster->setEmail('azueraMj'.$i.'@mail.com');
            $password = $this->hasher->hashPassword($gameMaster, 'aze123');
            $gameMaster->setPassword($password);
            $gameMaster->setName('gameMaster'.$i);
            $manager->persist($gameMaster);
        }
        for ($i = 0; $i < 3; ++$i) {
            $user = new User();
            $user->setEmail('azueraUser'.$i.'@mail.com');
            $password = $this->hasher->hashPassword($user, 'aze123');
            $user->setPassword($password);
            $user->setName('user.$i');
            $manager->persist($user);
        }
        $manager->flush();
    }
}
