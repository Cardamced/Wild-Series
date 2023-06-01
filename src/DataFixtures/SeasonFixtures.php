<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $season = new Season();
        $season->setYear(2021);
        $season->setDescription('première saison très très bien');
        $season->setNumber(1);
        $season->setProgram($this->getReference('program_Arcane'));
        $manager->persist($season);
        $manager->flush();
        $this->addReference('season1_Arcane', $season);

        $season = new Season();
        $season->setYear(2022);
        $season->setDescription('deuxième saison encore mieux');
        $season->setNumber(2);
        $season->setProgram($this->getReference('program_Arcane'));
        $manager->persist($season);
        $manager->flush();
        $this->addReference('season2_Arcane', $season);

        $season = new Season();
        $season->setYear(2023);
        $season->setDescription('troisième saison un poil moins bien que la deux mais mieux que la première.');
        $season->setNumber(3);
        $season->setProgram($this->getReference('program_Arcane'));
        $manager->persist($season);
        $manager->flush();
        $this->addReference('season3_Arcane', $season);
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}