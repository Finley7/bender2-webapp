<?php

namespace App\Repository;

use App\Entity\StudentResetToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StudentResetToken>
 *
 * @method StudentResetToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentResetToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentResetToken[]    findAll()
 * @method StudentResetToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentResetTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, StudentResetToken::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(StudentResetToken $studentResetToken, bool $flush = true): void
    {
        $this->_em->persist($studentResetToken);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(StudentResetToken $studentResetToken, bool $flush = true): void
    {
        $this->_em->remove($studentResetToken);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return StudentResetToken[] Returns an array of StudentResetToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudentResetToken
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
