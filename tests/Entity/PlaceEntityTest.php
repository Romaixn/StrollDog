<?php

namespace App\Tests\Entity;

use App\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlaceEntityTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testLongitudeAndLatitudeGenerate(): void
    {
        $place = new Place();
        $place->setTitle('Place');
        $place->setAddress('8 bd du port');
        $place->setPostalCode('44380');
        $place->setCity('Nantes');

        $this->entityManager->persist($place);
        $this->entityManager->flush();

        $this->assertEquals(-2.340983, $place->getLongitude());
        $this->assertEquals(47.258811, $place->getLatitude());

        $this->entityManager->remove($place);
        $this->entityManager->flush();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
