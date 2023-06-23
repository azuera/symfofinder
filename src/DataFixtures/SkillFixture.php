<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $skills = new Skill();
        $skills->setName('baton');
        $skills->setLevel(10);
        $manager->flush();
    }
}
