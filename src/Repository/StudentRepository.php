<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Student::class);
    }

    public function findByUuid(string $uuid) {
        return $this->createQueryBuilder('s')
            ->where('s.uuid = :uuid')
            ->setParameter('uuid', Uuid::fromString($uuid))
            ->getQuery()
            ->setMaxResults(1)
            ->getResult();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function login(string $studentNumber, string $password) {

        $student =  $this->createQueryBuilder('s')
            ->where('s.studentNumber = :studentNumber')
            ->setParameter('studentNumber', $studentNumber)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        $student = $student[0];

        if($student == null) {
            return false;
        }

        if(password_verify($password, (string) $student->getPassword())) {
            return $student;
        }

        return false;
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
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
    public function findOneBySomeField($value): ?Student
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
