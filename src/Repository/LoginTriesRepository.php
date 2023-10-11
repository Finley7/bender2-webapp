<?php

namespace App\Repository;

use App\Entity\LoginTry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LoginTry|null find($id, $lockMode = null, $lockVersion = null)
 * @method LoginTry|null findOneBy(array $criteria, array $orderBy = null)
 * @method LoginTry[]    findAll()
 * @method LoginTry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoginTriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, LoginTry::class);
    }

    public function findLatestLoginTries(string $username) {
        return $this->createQueryBuilder('lt')
            ->where('lt.created > :fifteenMinutes')
            ->andWhere('lt.username = :username')
            ->orWhere('lt.ipAddress = :ipAddress')
            ->setParameter('fifteenMinutes', new \DateTime('-5 minutes'))
            ->setParameter('username', $username)
            ->setParameter('ipAddress', $_SERVER['REMOTE_ADDR'])
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return LoginTries[] Returns an array of LoginTries objects
    //  */
    /*
    public_html function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public_html function findOneBySomeField($value): ?LoginTries
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
