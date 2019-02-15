<?php

namespace App\Repository;

use App\Entity\Conference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Conference|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conference|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conference[]    findAll()
 * @method Conference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConferenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Conference::class);
    }
    
    public function findPage( int $numberPerPage, int $numberPage )
    {
        $limit  = $numberPerPage;
        $offset = $numberPerPage * $numberPage;

        // var_dump($limit);
        // var_dump($offset);

        // select conferences with average for each conference
        /*
        $qb = $this->createQueryBuilder('c');
        
        $qb
            ->select('c, u, AVG(ratings.value) as rating')
            ->join("c.ratings", "ratings")
            ->join("ratings.user", "u")
            ->orderBy('rating', 'DESC')
        ;
        */

        $qb = $this->createQueryBuilder('c');
        $qb
            ->addSelect('c.id, c.title, (c.id) as id_conf, (c.title) as titleConf')
            ->join('c.ratings', 'r')
            ->addSelect('AVG(r.value) as rating', 'COUNT(r.id) as numberVote')
            ->groupBy('c.id')
            ->orderBy('rating', 'DESC')
            ->setFirstResult( $offset )
            ->setMaxResults( $limit )
        ;

        return $qb->getQuery()
            ->getResult()
        ;

         /*
        return $this->createQueryBuilder('c')
            ->leftJoin("c.ratings", "ratings")
            ->Where('c.id IS NOT NULL')
            ->GroupBy('c.id')
            ->having('count(ratings) = 0')
            ->setFirstResult( $offset )
            ->setMaxResults( $limit )
            ->getQuery()
            ->getResult()
        ;
        */
    }




    public function findUnrated()
    {
        return $this->createQueryBuilder('c')
            ->leftJoin("c.ratings", "ratings")
            ->Where('c.id IS NOT NULL')
            ->GroupBy('c.id')
            ->having('count(ratings) = 0')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findRated()
    {
        return $this->createQueryBuilder('c')
            ->leftJoin("c.ratings", "ratings")
            ->Where('c.id IS NOT NULL')
            ->GroupBy('c.id')
            ->having('count(ratings) > 0')
            ->getQuery()
            ->getResult()
        ;
    }

    public function searchKeyword(string $keyword)
    {
        return $this->createQueryBuilder('c')
            ->Where("c.title LIKE '%:keyword%'")
            ->setParameter('keyword', $keyword)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Conference[] Returns an array of Conference objects
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
    public function findOneBySomeField($value): ?Conference
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
