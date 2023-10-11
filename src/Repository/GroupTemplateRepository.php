<?php

namespace App\Repository;

use App\Entity\GroupTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupTemplate[]    findAll()
 * @method GroupTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, GroupTemplate::class);
    }

    // /**
    //  * @return GroupTemplate[] Returns an array of GroupTemplate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupTemplate
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
