<?php

namespace App\Repository;

use App\Entity\StudentGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentGroup[]    findAll()
 * @method StudentGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, StudentGroup::class);
    }

    public function findStudentsInGroup(array $groups) {
        return $this->createQueryBuilder('sg')
            ->where('sg.name IN (:sgArray)')
            ->setParameter('sgArray', $groups)
            ->getQuery()
            ->getResult();
    }

    public function findGroupsSorted() {
        return $this->createQueryBuilder('sg')
            ->orderBy('sg.name', 'ASC');
    }

    // /**
    //  * @return StudentGroup[] Returns an array of StudentGroup objects
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
    public function findOneBySomeField($value): ?StudentGroup
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
