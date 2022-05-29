<?php

namespace App\Tests\Repository;

use App\Domain\Place\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TypeRepositoryTest extends KernelTestCase
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
            ->getRepository(Type::class)
            ->findAll()
        ;

        $this->assertCount(3, $projects);
    }

    public function testFindByName(): void
    {
        $category = $this->entityManager
            ->getRepository(Type::class)
            ->findOneBy(['name' => 'Ville'])
        ;

        $this->assertNotNull($category);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
