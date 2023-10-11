<?php

namespace App\Repository;

use App\Entity\ChallengeBoardAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChallengeBoardAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChallengeBoardAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChallengeBoardAttachment[]    findAll()
 * @method ChallengeBoardAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChallengeBoardAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChallengeBoardAttachment::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ChallengeBoardAttachment $challengeBoardAttachment, bool $flush = true): void
    {
        $this->_em->persist($challengeBoardAttachment);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ChallengeBoardAttachment $challengeBoardAttachment, bool $flush = true): void
    {
        $this->_em->remove($challengeBoardAttachment);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ChallengeBoardAttachment[] Returns an array of ChallengeBoardAttachment objects
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
    public function findOneBySomeField($value): ?ChallengeBoardAttachment
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
