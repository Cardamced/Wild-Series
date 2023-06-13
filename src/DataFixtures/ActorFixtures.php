<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
            $faker = Factory::create('fr_FR');
            for ($i = 0; $i < 10; $i++) {
                $actor = new Actor();
                $actor->setLastname($faker->lastname());
                $actor->addProgram($this->getReference('program_' . $faker->numberBetween(0, 3)));
                $this->addReference('actor_' . $i, $actor);
                $manager->persist($actor);
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
