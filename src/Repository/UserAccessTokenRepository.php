<?php

namespace App\Repository;

use App\Entity\UserAccessToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserAccessToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAccessToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAccessToken[]    findAll()
 * @method UserAccessToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAccessTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, UserAccessToken::class);
    }

    // /**
    //  * @return UserAccessToken[] Returns an array of UserAccessToken objects
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
    public function findOneBySomeField($value): ?UserAccessToken
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
