<?php

namespace App\Repository;

use App\Entity\TratamientoConcepto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TratamientoConcepto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TratamientoConcepto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TratamientoConcepto[]    findAll()
 * @method TratamientoConcepto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TratamientoConceptoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TratamientoConcepto::class);
    }

    // /**
    //  * @return TratamientoConcepto[] Returns an array of TratamientoConcepto objects
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
    public function findOneBySomeField($value): ?TratamientoConcepto
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
