<?php

declare(strict_types=1);

namespace App\Domain\Place\Repository;

use App\Domain\Place\Entity\Place;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Place|null find($id, $lockMode = null, $lockVersion = null)
 * @method Place|null findOneBy(array $criteria, array $orderBy = null)
 * @method Place[]    findAll()
 * @method Place[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Place>
 */
class PlaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Place::class);
    }

    public function getNumber(): mixed
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getNumberCity(): mixed
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(DISTINCT(p.city))')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findLatest(): mixed
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(9)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Place[] Returns an array of Place objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Place
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
