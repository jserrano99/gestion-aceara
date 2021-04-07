<?php

namespace App\Repository;

use App\Entity\TipoIva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoIva|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoIva|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoIva[]    findAll()
 * @method TipoIva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoIvaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoIva::class);
    }

    // /**
    //  * @return TipoIva[] Returns an array of TipoIva objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoIva
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
