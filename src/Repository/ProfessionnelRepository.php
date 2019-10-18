<?php

namespace App\Repository;

use App\Entity\Professionnel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserPro|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserPro|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserPro[]    findAll()
 * @method UserPro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfessionnelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Professionnel::class);
    }

    // /**
    //  * @return UserPro[] Returns an array of UserPro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserPro
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
