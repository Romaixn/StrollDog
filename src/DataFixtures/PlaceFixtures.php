<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Place;
use App\Entity\Type;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $ville = (new Type())
            ->setName('Ville');
        $manager->persist($ville);

        $foret = (new Type())
            ->setName('Foret');
        $manager->persist($foret);

        $champ = (new Type())
            ->setName('Champ');
        $manager->persist($champ);

        for ($i=0; $i < 100; $i++) {
            $place = (new Place())
                ->setTitle($faker->text(10))
                ->setDescription($faker->realText())
                ->setAddress($faker->streetAddress())
                ->setCity($faker->city())
                ->setPostalCode($faker->departmentNumber())
                ->setCountry($faker->country())
                ->setLongitude($faker->longitude())
                ->setLatitude($faker->latitude())
                ->setRatings($faker->randomFloat(2, 0, 5))
                ->setInflux($faker->randomElement(['Peu de monde', 'Modéré', 'Beaucoup de monde']))
                ->addType($faker->randomElement([$ville, $foret, $champ]))
            ;

            $manager->persist($place);
        }

        $manager->flush();
    }
}
