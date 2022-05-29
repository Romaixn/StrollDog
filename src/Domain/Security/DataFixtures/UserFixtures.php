<?php

namespace App\Domain\Security\DataFixtures;

use Faker;
use App\Domain\Security\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $encoder)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = new User();
        $user->setEmail('admin@strolldog.com');
        $user->setUsername('admin');
        $user->setName('Admin');
        $user->setPassword($this->encoder->hashPassword($user, 'admin'));
        $user->setIsVerified(true);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        for ($i=0; $i < 20; $i++) {
            $user = (new User())
                ->setUsername($faker->userName())
                ->setEmail($faker->email())
                ->setPassword($faker->password())
                ->setName($faker->name())
                ->setIsVerified($faker->boolean())
            ;

            $manager->persist($user);
        }

        $manager->flush();
    }
}
