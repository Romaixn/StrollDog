<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Domain\Place\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PlaceRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFindAll(): void
    {
        $projects = $this->entityManager
            ->getRepository(Place::class)
            ->findAll()
        ;

        $this->assertCount(100, $projects);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
