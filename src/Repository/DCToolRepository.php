<?php

namespace App\Repository;

use App\Entity\DCTool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DCTool>
 *
 * @method DCTool|null find($id, $lockMode = null, $lockVersion = null)
 * @method DCTool|null findOneBy(array $criteria, array $orderBy = null)
 * @method DCTool[]    findAll()
 * @method DCTool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DCToolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, DCTool::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(DCTool $dcTool, bool $flush = true): void
    {
        $this->_em->persist($dcTool);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(DCTool $dcTool, bool $flush = true): void
    {
        $this->_em->remove($dcTool);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return DCTool[] Returns an array of DCTool objects
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
    public function findOneBySomeField($value): ?DCTool
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
