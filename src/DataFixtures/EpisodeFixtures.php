<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episode = new Episode();
        $episode->setTitle('Welcome to the Playground');
        $episode->setNumber(1);
        $episode->setDescription('Les sœurs orphelines Vi et Powder causent des remous dans les rues souterraines de Zaun à la suite d\'un braquage dans le très huppé Piltover. ');
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Some Mysteries Are Better Left Unsolved');
        $episode->setNumber(2);
        $episode->setDescription('Idéaliste, le chercheur Jayce tente de maîtriser la magie par la science malgré les avertissements de son mentor. Le criminel Silco teste une substance puissante.');
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('The Base Violence Necessary for Change');
        $episode->setDescription('Deux anciens rivaux s\'affrontent lors d\'un défi spectaculaire qui se révèle fatidique pour Zaun. Jayce et Viktor prennent de gros risques pour leurs recherches.');
        $episode->setNumber(3);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Happy Progress Day!');
        $episode->setDescription('Deux anciens rivaux s\'affrontent lors d\'un défi spectaculaire qui se révèle fatidique pour Zaun. Jayce et Viktor prennent de gros risques pour leurs recherches.');  
        $episode->setNumber(4);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Everybody Wants to Be My Enemy');
        $episode->setDescription('Alors que Piltover profite de leur technologie, Jayce et Viktor réfléchissent à ce qu\'ils vont faire. Un visage familier ressort de Zaun pour semer la pagaille.');
        $episode->setNumber(5);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Quand l\'empire s\'effondre');
        $episode->setDescription('Caitlyn, la pacifieuse qui n\'en fait qu\'à sa tête, arpente les bas-fonds pour trouver Silco. Jayce devient une cible en combattant la corruption à Piltover.');
        $episode->setNumber(6);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Le petit sauveur');
        $episode->setDescription('Un protégé discrédite son mentor devant le Conseil à cause de l\'évolution rapide d\'une technologie magique. Poursuivie par les autorités, Jinx doit affronter son passé.');
        $episode->setNumber(7);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('L\'eau et l\'huile');
        $episode->setDescription('Caitlyn et Vi retrouvent un allié dans les rues de Zaun et se déchaînent contre une ennemie commune. Viktor prend une décision désespérée.');
        $episode->setNumber(8);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Rouages et engrenages');
        $episode->setDescription('L\'héritière désavouée Mel et sa mère échangent des tactiques de combat. Caitlyn et Vi forgent une alliance improbable. Jinx subit une étonnante transformation.');
        $episode->setNumber(9);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Où est Charlie ?');
        $episode->setDescription('À deux doigts d\'entrer en guerre, les chefs de Piltover et de Zaun sont face à un ultimatum, jusqu\'à ce qu\'un affrontement fatidique bouleverse les deux villes à jamais.');
        $episode->setNumber(10);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);
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