<?php

namespace App\Repository;

use App\Entity\InfosForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InfosForm>
 *
 * @method InfosForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfosForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfosForm[]    findAll()
 * @method InfosForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfosFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfosForm::class);
    }

//    /**
//     * @return InfosForm[] Returns an array of InfosForm objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InfosForm
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
