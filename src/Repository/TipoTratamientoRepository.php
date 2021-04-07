<?php

namespace App\Repository;

use App\Entity\TipoTratamiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoTratamiento|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoTratamiento|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoTratamiento[]    findAll()
 * @method TipoTratamiento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoTratamientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoTratamiento::class);
    }

    // /**
    //  * @return TipoTratamiento[] Returns an array of TipoTratamiento objects
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
    public function findOneBySomeField($value): ?TipoTratamiento
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
