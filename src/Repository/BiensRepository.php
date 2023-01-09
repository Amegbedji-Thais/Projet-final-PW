<?php

namespace App\Repository;

use App\Controller\SearchController;
use App\Entity\Biens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormInterface;

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
    public function searchBiens($search):array {
        //Je crée une requête à l'aide de créate builder qui sait dans quelle entité nous nous trouvons.
        $query = $this->createQueryBuilder('b')
            //J'ajoute une champs, ici catégorie que j'alias en q.
            ->join('b.categorie', 'q')
            //J'ajoute un critère de recheche.
            ->where('q = :catTitre')
            //Je définis le paramètre, cela permet d'éviter les injections sql.
            ->setParameter(':catTitre', $search->getCategorie()->getId())
            ->andWhere('b.type_bien = :typeB')
            ->setParameter(':typeB', $search->getTypeBien())
        ;
        //Je crée et exécute la requête.
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
