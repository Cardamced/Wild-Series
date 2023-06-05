<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    const SEASONS = [
        ['number' => '1', 'year' => '1992', 'description' => 'La saison 1 de X-files', 'program' => 'X-files'],
        ['number' => '2', 'year' => '1993', 'description' => 'La saison 2 de X-files', 'program' => 'X-files'],
        ['number' => '3', 'year' => '1994', 'description' => 'La saison 3 de X-files', 'program' => 'X-files'],
    ];
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $season = new Season();
            $season->setNumber($faker->numberBetween(1, 10));
            $season->setYear($faker->year());
            $season->setSynopsis($faker->paragraphs(3, true));
            $season->setProgram($this->getReference('program_' . $faker->numberBetween(0, 4)));
            $this->addReference('season_' . $i, $season);
            $manager->persist($season);
        }
       
        $manager->flush();

    }
    
    public function getDependencies(): array
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}