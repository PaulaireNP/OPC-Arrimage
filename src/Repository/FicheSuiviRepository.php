<?php

namespace App\Repository;

use App\Entity\FicheSuivi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheSuivi>
 *
 * @method FicheSuivi|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheSuivi|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheSuivi[]    findAll()
 * @method FicheSuivi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheSuiviRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheSuivi::class);
    }

    /**
     * @return FicheSuivi[] Returns an array of FicheSuivi objects
     */
    public function findByUser($value): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.jeune = :val')
            ->setParameter('val', $value)
            ->orderBy('f.creationDate', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?FicheSuivi
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
