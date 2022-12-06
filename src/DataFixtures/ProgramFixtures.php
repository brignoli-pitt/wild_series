<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program1 = new Program();
        $program1->setTitle('Walking dead');
        $program1->setSynopsis('Des zombies envahissent la terre');
        $program1->setCategory($this->getReference('category_Action'));
        $manager->persist($program1);

        $program2 = new Program();
        $program2->setTitle('Retour vers le futur');
        $program2->setSynopsis('Nom de Zeus!');
        $program2->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program2);

        $program3 = new Program();
        $program3->setTitle('Your name');
        $program3->setSynopsis('Romance et lien temporel');
        $program3->setCategory($this->getReference('category_Animation'));
        $manager->persist($program3);

        $program4 = new Program();
        $program4->setTitle('La ligne verte');
        $program4->setSynopsis('Le colosse John Coffey');
        $program4->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program4);

        $program5 = new Program();
        $program5->setTitle('Scream');
        $program5->setSynopsis('Un assasin avec un masque');
        $program5->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program5);

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
