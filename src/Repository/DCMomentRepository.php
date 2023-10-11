<?php

namespace App\Repository;

use App\Entity\DCMoment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DCMoment>
 *
 * @method DCMoment|null find($id, $lockMode = null, $lockVersion = null)
 * @method DCMoment|null findOneBy(array $criteria, array $orderBy = null)
 * @method DCMoment[]    findAll()
 * @method DCMoment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DCMomentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, DCMoment::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DCMoment $dcMoment, bool $flush = true): void
    {
        $this->_em->persist($dcMoment);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(DCMoment $dcMoment, bool $flush = true): void
    {
        $this->_em->remove($dcMoment);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return DCMoment[] Returns an array of DCMoment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DCMoment
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
