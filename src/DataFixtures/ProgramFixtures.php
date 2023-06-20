<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = [
        ['title' => 'Walking Dead', 'description' => 'Des zombies envahissent la terre', 'category' => 'Action'],
        ['title' => 'X-files', 'description' => 'Deux agents enquêtent sur des affaires non classées', 'category' => 'Fantastique'],
        ['title' => 'Clarice', 'description' => 'l\'agent du FBI Clarice Starling poursuit des meurtriers et des prédateurs sexuels.', 'category' => 'Horreur'],
        ['title' => 'Rick and Morty', 'description' => 'Un brillant inventeur et son petit fils un peu à l\'Ouest partent à l\'aventure...', 'category' => 'Animation'],
        ['title' => 'Arcane', 'description' => 'Une série qui fait peur', 'category' => 'Animation'],
        ['title' => 'Secret Invasion', 'description' => 'Nick Fury rejoint ses alliés pour empêcher l\'envahissement imminent de la Terre.', 'category' => 'Aventure'],
    ];
   
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $programName) {
            $program = new Program();
            $program
                ->setTitle($programName['title'])
                ->setDescription($programName['description'])
                ->setCategory($this->getReference('category_' . $programName['category']));
            $slug = $this->slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $this->addReference('program_' . $key, $program);

            $manager->persist($program);
        }
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
