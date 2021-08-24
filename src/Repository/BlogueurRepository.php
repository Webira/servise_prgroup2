<?php

namespace App\Repository;

use App\Entity\Blogueur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Blogueur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blogueur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blogueur[]    findAll()
 * @method Blogueur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogueurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blogueur::class);
    }

    // /**
    //  * @return Blogueur[] Returns an array of Blogueur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Blogueur
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
