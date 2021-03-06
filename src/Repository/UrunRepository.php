<?php

namespace App\Repository;

use App\Entity\Kategori;
use App\Entity\Urun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Urun|null find($id, $lockMode = null, $lockVersion = null)
 * @method Urun|null findOneBy(array $criteria, array $orderBy = null)
 * @method Urun[]    findAll()
 * @method Urun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {

        parent::__construct($registry, Urun::class);
    }

    public function findAllGreateThan(int $fiyat)
    {
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.fiyat > :fiyat')
            ->setParameter('fiyat',$fiyat)
            ->orderBy('u.fiyat','ASC')
            ->getQuery();
        return $qb->execute();
    }

    public function finByCategory(Kategori $kategori){
        return $this->createQueryBuilder('u')
            ->andWhere('u.kategori = :kategori')
            ->setParameter('kategori',$kategori)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Urun[] Returns an array of Urun objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Urun
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
