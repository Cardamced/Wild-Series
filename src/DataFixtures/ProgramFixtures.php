<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = [
        ['title' => 'Walking Dead', 'synopsis' => 'Des zombies envahissent la terre', 'category' => 'Action'],
        ['title' => 'X-files', 'synopsis' => 'Deux agents enquêtent sur des affaires non classées', 'category' => 'Fantastique'],
        ['title' => 'Clarice', 'synopsis' => 'l\'agent du FBI Clarice Starling poursuit des meurtriers et des prédateurs sexuels.','category' => 'Horreur'],
        ['title' => 'Rick and Morty', 'synopsis' => 'Un brillant inventeur et son petit fils un peu à l\'Ouest partent à l\'aventure...', 'category' => 'Animation'],
        ['title' => 'Arcane', 'synopsis' => 'Une série qui fait peur', 'category' => 'Animation'],
        ['title' => 'Secret Invasion', 'synopsis' => 'Nick Fury rejoint ses alliés pour empêcher l\'envahissement imminent de la Terre.', 'category' => 'Aventure'],
    ];

        public function load(ObjectManager $manager)
       {
           foreach (self::PROGRAMS as $key => $programName) {
               $program = new Program();
               $program
                ->setTitle($programName['title'])
                ->setSynopsis($programName['synopsis'])
                ->setCategory($this->getReference('category_' . $programName['category']));
             $this->addReference('program_' . $key, $program);
             $manager->persist($program);
           }
           $manager->flush();
       }

       //categoriesFixtures::Categories --> bloucler sur la constante de la catégorie mère pour avoir 5

        //ex : pour chacun des programmes de chaque catégorie, je génère X épisodes.

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
