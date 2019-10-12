<?php

namespace App\Repository;

use App\Entity\CaracTech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaracTech|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaracTech|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaracTech[]    findAll()
 * @method CaracTech[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracTechRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaracTech::class);
    }

    // /**
    //  * @return CaracTech[] Returns an array of CaracTech objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CaracTech
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
