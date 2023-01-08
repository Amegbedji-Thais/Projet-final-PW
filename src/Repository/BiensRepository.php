<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Biens;
use App\Form\SearchForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Biens>
 *
 * @method Biens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Biens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Biens[]    findAll()
 * @method Biens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiensRepository extends ServiceEntityRepository{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Biens::class);
    }

    public function save(Biens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Biens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * Récupère les produits en lien avec une recherche
     * @return Biens[]
     */
    public function findSearch(SearchData $search):array {
        $query = $this
            ->createQueryBuilder('p')
            ->select('c','p')
            ->join('p.categories', 'c');

        if(!empty($search->q)){
            $query = $query
            ->andWhere('p.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if(!empty($search->min)){
            $query = $query
                ->andWhere('p.prixbien >= :min')
                ->setParameter('min', $search->min);
        }

        if(!empty($search->max)){
            $query = $query
                ->andWhere('p.prixbien <= :max')
                ->setParameter('max', $search->max);
        }

        return $query->getQuery()->getResult();
    }


//    /**
//     * @return Biens[] Returns an array of Biens objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Biens
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
