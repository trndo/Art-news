<?php

namespace App\Repository;

use App\Entity\ResumeTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ResumeTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResumeTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResumeTranslation[]    findAll()
 * @method ResumeTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResumeTranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ResumeTranslation::class);
    }

    // /**
    //  * @return ResumeTranslation[] Returns an array of ResumeTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResumeTranslation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
