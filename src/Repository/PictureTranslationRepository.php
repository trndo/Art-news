<?php

namespace App\Repository;

use App\Entity\PictureTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PictureTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PictureTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PictureTranslation[]    findAll()
 * @method PictureTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureTranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PictureTranslation::class);
    }

    // /**
    //  * @return PictureTranslation[] Returns an array of PictureTranslation objects
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
    public function findOneBySomeField($value): ?PictureTranslation
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
