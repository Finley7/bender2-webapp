<?php

namespace App\Repository;

use App\Entity\ChallengeBoard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChallengeBoard|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChallengeBoard|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChallengeBoard[]    findAll()
 * @method ChallengeBoard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChallengeBoardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChallengeBoard::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ChallengeBoard $challengeBoard, bool $flush = true): void
    {
        $this->_em->persist($challengeBoard);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ChallengeBoard $challengeBoard, bool $flush = true): void
    {
        $this->_em->remove($challengeBoard);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ChallengeBoard[] Returns an array of ChallengeBoard objects
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
    public function findOneBySomeField($value): ?ChallengeBoard
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
