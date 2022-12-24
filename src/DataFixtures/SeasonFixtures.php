<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    const NUMBERS = [1,2,3,4,5];
    const YEARS = [];

    public function load(ObjectManager $manager): void
    {
        $season = new Season();
        $season->setNumber('1');
        $season->setYear('2010');
        $season->setDescription('première saison');
        $season->setProgram($this->getReference('program_1'));
        $manager->persist($season);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
