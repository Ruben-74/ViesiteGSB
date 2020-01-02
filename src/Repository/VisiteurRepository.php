<?php

namespace App\Repository;

use App\Entity\Search;
use App\Entity\Visiteur;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Visiteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visiteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visiteur[]    findAll()
 * @method Visiteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visiteur::class);
    }

    // /**
    //  * @return Visiteur[] Returns an array of Visiteur objects
    //  */
    

    public function searchVisiteur($crit)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.lesecteur', 'lesecteur')
            ->leftJoin('s.ledepartement', 'ledepartement')
            ->Where('lesecteur.libelle_sec = :secteurName')
            ->setParameter('secteurName', $crit['lesecteur']->getLibelleSec())
            ->andWhere('ledepartement.nom_Dep = :DepName')
            ->setParameter('DepName', $crit['ledepartement']->getNomDep())
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Visiteur
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
