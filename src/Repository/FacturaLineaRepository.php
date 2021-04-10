<?php

namespace App\Repository;

use App\Entity\FacturaLinea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FacturaLinea|null find($id, $lockMode = null, $lockVersion = null)
 * @method FacturaLinea|null findOneBy(array $criteria, array $orderBy = null)
 * @method FacturaLinea[]    findAll()
 * @method FacturaLinea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacturaLineaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FacturaLinea::class);
    }

    // /**
    //  * @return FacturaLinea[] Returns an array of FacturaLinea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FacturaLinea
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
