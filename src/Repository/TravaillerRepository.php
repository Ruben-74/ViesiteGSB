<?php

namespace App\Repository;

use App\Entity\Travailler;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Travailler|null find($id, $lockMode = null, $lockVersion = null)
 * @method Travailler|null findOneBy(array $criteria, array $orderBy = null)
 * @method Travailler[]    findAll()
 * @method Travailler[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TravaillerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Travailler::class);
    }

    // /**
    //  * @return Travailler[] Returns an array of Travailler objects
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
    public function findOneBySomeField($value): ?Travailler
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
