<?php

namespace App\DataFixtures;

use App\Entity\CharacterSheet;
use App\Repository\EquipementRepository;
use App\Repository\GameRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CharacterSheetFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(UserRepository $userRepository, GameRepository $gameRepository, EquipementRepository $equipementRepository, SkillRepository $skillRepository)
    {
        $this->userRepository = $userRepository;
        $this->gameRepository = $gameRepository;
        $this->skillRepository = $skillRepository;
        $this->equipementRepository = $equipementRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $name = 'azuera';
        $race = 'elfe';
        $class = 'rogue';
        $status = 10;
        $initiative = 10;
        $hpMax = 100;
        $actualHp = 100;
        $mpMax = 100;
        $actualMp = 100;
        $strenght = 10;
        $dexterity = 10;
        $stamina = 10;
        $intelligence = 10;
        $wisdom = 10;
        $luck = 10;
        $users = $this->userRepository->findAll();
        $equipements = $this->equipementRepository->findAll();
        $skills = $this->skillRepository->findAll();
        //        $games = $this -> gameRepository -> findAll();
        for ($i = 0; $i < 6; ++$i) {
            $characterSheet = new CharacterSheet();
            $characterSheet->setName($name.$i);
            $characterSheet->setRace($race.$i);
            $characterSheet->setClass($class.$i);
            $characterSheet->setStatus($status);
            $characterSheet->setInitiative($initiative);
            $characterSheet->setHpMax($hpMax);
            $characterSheet->setActualHp($actualHp);
            $characterSheet->setMpMax($mpMax);
            $characterSheet->setActualMp($actualMp);
            $characterSheet->setStrength($strenght);
            $characterSheet->setDexterity($dexterity);
            $characterSheet->setStamina($stamina);
            $characterSheet->setIntelligence($intelligence);
            $characterSheet->setWisdom($wisdom);
            $characterSheet->setLuck($luck);
            $characterSheet->setCharacterSheetUser($users[mt_rand(0, count($users) - 1)]);
            //            $characterSheet->setGame($games[mt_rand(0, count($games) - 1)]);
            //            $characterSheet->addSkill($skills[mt_rand(0, count($skills) + 1)]);
            //            $characterSheet->addEquipement($equipements[mt_rand(0, count($equipements) + 1)]);
            $manager->persist($characterSheet);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
