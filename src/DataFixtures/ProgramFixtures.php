<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setTitle('Walking Dead');
        $program ->setSynopsis('Des zombies envahissent la Terre');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('X-files');
        $program->setSynopsis('Deux agents enquêtent sur des affaires non classées');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Clarice');
        $program->setSynopsis('l\'agent du FBI Clarice Starling poursuit des meurtriers et des prédateurs sexuels.');
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Rick and Morty');
        $program->setSynopsis('Un brillant inventeur et son petit fils un peu à l\'Ouest partent à l\'aventure...');
        $program->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Secret Invasion');
        $program->setSynopsis('Nick Fury rejoint ses alliés pour empêcher l\'envahissement imminent de la Terre.');
        $program->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program);
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