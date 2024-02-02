<?php

namespace App\Repository;

use App\Entity\Jeune;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jeune>
 *
 * @method Jeune|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jeune|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jeune[]    findAll()
 * @method Jeune[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JeuneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jeune::class);
    }

    /**
     * @return Jeune[] Returns an array of Jeune objects
     */
    public function findBySecteur($value): array
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.secteur = :val')
            ->setParameter('val', $value)
            ->orderBy('j.lastModification', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByReferentEduc($value): array
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.referentEduc = :val')
            ->setParameter('val', $value)
            ->orderBy('j.lastModification', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByCoReferentEduc($value): array
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.coreferentEduc = :val')
            ->setParameter('val', $value)
            ->orderBy('j.lastModification', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findOneBySomeField($value): ?Jeune
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
