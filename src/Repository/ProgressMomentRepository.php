<?php

namespace App\Repository;

use App\Entity\ProgressMoment;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgressMoment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgressMoment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgressMoment[]    findAll()
 * @method ProgressMoment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgressMomentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ProgressMoment::class);
    }

    public function findWithStudent(Student $student) {
        return $this->createQueryBuilder('p')
            ->where('p.student = :student')
            ->orderBy('p.created', 'desc')
            ->setParameter('student', $student)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return ProgressMoment[] Returns an array of ProgressMoment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProgressMoment
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
