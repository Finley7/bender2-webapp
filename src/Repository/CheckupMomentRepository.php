<?php

namespace App\Repository;

use App\Entity\CheckupMoment;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CheckupMoment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckupMoment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckupMoment[]    findAll()
 * @method CheckupMoment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckupMomentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, CheckupMoment::class);
    }

    public function findBySchoolyear($schoolYear, $type = 'checkup_moment') {

        $datetime = new \DateTime('25-08-' . $schoolYear);

        return $this->createQueryBuilder('cm')
            ->where('cm.start > :schoolyear')
            ->andWhere('cm.type = :type')
            ->orderBy('cm.createdBy', 'ASC')
            ->setParameter('schoolyear', $datetime)
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();
    }

    public function countAll($type = 'present_check', $schoolyear = '2022') {

        $datetime = new \DateTime('25-08-' . $schoolyear);

        $countQuery =  $this->createQueryBuilder('cm')
            ->where('cm.type = :type')
            ->andWhere('cm.start > :schoolyear');

        return $countQuery->select('count(cm.id)')
            ->setParameter('type', $type)
            ->setParameter('schoolyear', $datetime)
            ->getQuery()
            ->getSingleColumnResult();
    }

    public function findFirstCheckupMomentWithStudent(Student $student, $cohort = null) {
        $queryBuilder =  $this->createQueryBuilder('cm')
            ->leftJoin('cm.students', 'cms')
            ->where('cms.student = :student')
            ->orderBy('cm.start', 'asc')
            ->setParameter('student', $student);

        if($cohort != null) {
            $cohort = new \DateTime('25-08-' . $cohort);
            $queryBuilder->andWhere('cm.start > :cohort')
                ->setParameter('cohort', $cohort);
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    public function findLatestCheckupMoment(Student $student, $cohort = null) {
        $queryBuilder = $this->createQueryBuilder('cm')
            ->leftJoin('cm.students', 'cms')
            ->where('cms.student = :student')
            ->orderBy('cm.start', 'desc')
            ->setParameter('student', $student);

        if($cohort != null) {
            $cohort = new \DateTime('25-08-' . $cohort);
            $queryBuilder->andWhere('cm.start > :cohort')
                ->setParameter('cohort', $cohort);
        }

        $result = $queryBuilder->setMaxResults(1)
            ->getQuery()
            ->getResult();

        if(count($result) != 0) {
            return $result[0];
        }

        return [];
    }

    public function findAllStartedOnWithStudent(\DateTime $date, Student $student, $cohort = null) {

        $start_day = new \DateTime($date->format('d-m-Y') . ' 00:00:00');
        $end_day = new \DateTime($date->format('d-m-Y') . ' 23:59:59');

        $query = $this->createQueryBuilder('cm')
            ->where('cm.start BETWEEN :start_day AND :end_day')
            ->setParameter('start_day', $start_day)
            ->setParameter('end_day', $end_day)
            ->leftJoin('cm.students', 'cms')
            ->andWhere('cms.student = :student')
            ->setParameter('student', $student);

        if($cohort != null) {
            $cohort = new \DateTime('25-08-' . $cohort);
            $query->andWhere('cm.start > :cohort')
                ->setParameter('cohort', $cohort);
        }

        return $query->select(['cm.name', 'cm.start', 'cms.status'])
            ->getQuery()
            ->getResult();
    }

    public function findWithStudent(Student $student, $cohort = null) {

        $queryBuilder = $this->createQueryBuilder('cm')
            ->where('cm.end is not null')
            ->leftJoin('cm.students', 'cms')
            ->andWhere('cms.student = :student')
            ->setParameter('student', $student);

        if($cohort != null) {
            $cohort = new \DateTime('25-08-' . $cohort);
            $queryBuilder->andWhere('cm.start > :cohort')
                ->setParameter('cohort', $cohort);
        }

        return $queryBuilder->select(['cm.name', 'cm.start', 'cms.status'])
            ->getQuery()
            ->getResult();
    }

    public function findAllPresentChecks() {
        return $this->createQueryBuilder('cm')
            ->where('cm.type = :checkType')
            ->setParameter('checkType', 'present_check')
            ->getQuery()
            ->getResult();
    }

    public function findThisMonth() {
        return $this->createQueryBuilder('cm')
            ->where('cm.start BETWEEN :start_month AND :end_month')
            ->andWhere('cm.type = :present_type')
            ->setParameter('start_month', new \DateTime('first day of this month'))
            ->setParameter('end_month', new \DateTime('last day of this month'))
            ->setParameter('present_type', 'present_check')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return CheckupMoment[] Returns an array of CheckupMoment objects
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
    public function findOneBySomeField($value): ?CheckupMoment
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
