<?php

namespace App\Repository;

use App\Entity\ChallengeRace;
use App\Entity\ChallengeGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChallengeGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChallengeGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChallengeGroup[]    findAll()
 * @method ChallengeGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChallengeGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ChallengeGroup::class);
    }

    public function findByChallengeSortByProgress(ChallengeRace $challengeRace) {
        return $this->createQueryBuilder('c')
            ->where('c.challenge = :challenge')
            ->orderBy('c.progress', 'DESC')
            ->setParameter('challenge', $challengeRace)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return ChallengeGroup[] Returns an array of ChallengeGroup objects
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
    public function findOneBySomeField($value): ?ChallengeGroup
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
