<?php

namespace App\Repository;

use App\Entity\TacheUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TacheUtilisateur>
 *
 * @method TacheUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method TacheUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method TacheUtilisateur[]    findAll()
 * @method TacheUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacheUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TacheUtilisateur::class);
    }

//    /**
//     * @return TacheUtilisateur[] Returns an array of TacheUtilisateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TacheUtilisateur
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
