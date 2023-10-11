<?php

namespace App\Repository;

use App\Entity\StudentCheckupMoment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentCheckupMoment|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentCheckupMoment|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentCheckupMoment[]    findAll()
 * @method StudentCheckupMoment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentCheckupMomentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, StudentCheckupMoment::class);
    }

    public function countAll($schoolyear = '2022') {

        $datetime = new \DateTime('25-08-' . $schoolyear);

        return $this->createQueryBuilder('scm')
            ->select('scm.id, scm.created, scm.status')
            ->where('scm.created >= :date')
            ->setParameter('date', $datetime)
            ->getQuery()
            ->getResult();
    }

    public function countWithStatus($status = null, $schoolyear = '2022') {

        $datetime = new \DateTime('25-08-' . $schoolyear);

        return $this->createQueryBuilder('scm')
            ->leftJoin('scm.checkupMoment', 'cm')
            ->where('scm.status = :status')
            ->andWhere('cm.start > :schoolyear')
            ->select('count(scm.id)')
            ->setParameter('status', $status)
            ->setParameter('schoolyear', $datetime)
            ->getQuery()
            ->getSingleColumnResult();
    }

    // /**
    //  * @return StudentCheckupMoment[] Returns an array of StudentCheckupMoment objects
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
    public function findOneBySomeField($value): ?StudentCheckupMoment
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
