<?php

declare(strict_types=1);

namespace App\Domain\Place\DataFixtures;

use Faker;
use App\Domain\Place\Entity\Type;
use App\Domain\Place\Enum\Influx;
use App\Domain\Place\Entity\Place;
use App\Domain\Place\Entity\Comment;
use App\Domain\Security\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = (new User())
            ->setUsername('johndoe')
            ->setEmail('john@doe.fr')
            ->setPassword($faker->password())
            ->setName('John Doe')
            ->setIsVerified(true)
        ;
        $manager->persist($user);

        $ville = (new Type())
            ->setName('Ville');
        $manager->persist($ville);

        $foret = (new Type())
            ->setName('Foret');
        $manager->persist($foret);

        $champ = (new Type())
            ->setName('Champ');
        $manager->persist($champ);

        for ($i = 0; $i < 100; ++$i) {
            $place = new Place();
            $place
                ->setTitle($faker->text(10))
                ->setDescription($faker->realText())
                ->setAddress($faker->streetAddress())
                ->setCity($faker->city())
                /* @phpstan-ignore-next-line */
                ->setPostalCode((string) $faker->departmentNumber())
                ->setCountry($faker->country())
                ->setLongitude($faker->longitude())
                ->setLatitude($faker->latitude())
                ->setRatings($faker->randomFloat(2, 0, 5))
                /* @phpstan-ignore-next-line */
                ->setInflux($faker->randomElement([Influx::Low->name, Influx::Medium->name, Influx::High->name]))
                /* @phpstan-ignore-next-line */
                ->addType($faker->randomElement([$ville, $foret, $champ]))
                ->setCreator($user)
            ;

            for($j = 0; $j < $faker->numberBetween(0, 5); ++$j) {
                $comment = (new Comment())
                    ->setContent($faker->realText())
                    ->setCreator($user)
                    ->setRating($faker->numberBetween(1, 5))
                ;

                $place->addComment($comment);

                $manager->persist($comment);
            }


            $manager->persist($place);
        }

        $manager->flush();
    }
}
