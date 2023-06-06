<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public const EPISODES = [
        ['number' => '1', 'title' => 'I want to believe', 'description' => 'Mulder est dans un bureau oublié de tous', 'season' => '1',],
        ['number' => '1','title' => 'Deux agents', 'description' => 'Scully rencontre Mulder', 'season' => '1',],
        ['number' => '1','title' => 'Tooms', 'description' => 'Eugene Tooms sème la terreur', 'season' => '1',],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $episodeName) {
            $episode = new Episode();
            $episode
                ->setNumber($episodeName['number'])
                ->setTitle($episodeName['title'])
                ->setDescription($episodeName['description'])
                ->setSeason($this->getReference('season_' . $episodeName['season']));
            $manager->persist($episode);
        }
        $manager->flush();

        $faker = Factory::create();
        for ($i = 0; $i < 500; $i++) {
            $episode = new Episode();
            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setTitle($faker->title());
            $episode->setDescription($faker->paragraphs(3, true));
            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(0, 50)));
            $this->addReference('episode_' . $i, $episode);
            $manager->persist($episode);
        }

        $manager->flush();
    }



    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
//... set other episode's properties
//... create 2 more episodes