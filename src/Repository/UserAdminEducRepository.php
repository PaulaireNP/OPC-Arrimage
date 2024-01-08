<?php

namespace App\Repository;

use App\Entity\UserAdminEduc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserAdminEduc>
 *
 * @method UserAdminEduc|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAdminEduc|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAdminEduc[]    findAll()
 * @method UserAdminEduc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAdminEducRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAdminEduc::class);
    }

//    /**
//     * @return UserAdminEduc[] Returns an array of UserAdminEduc objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserAdminEduc
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
