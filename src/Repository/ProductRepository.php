<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }



/*************************************/

/**
 * @return Product[] Returns an array of Product objects which corresponding to starter dish
 **/

public function findAllStarterDishes()
{
    return $this->createQueryBuilder('p')
    ->join('p.category', 'c')
    ->where('c.name = :categoryName')
    ->setParameter('categoryName', 'Entrée')
    ->orderBy('p.id', 'ASC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult();
    }
    
    /**
     * @return Product[] Returns an array of Product objects which corresponding to main course
     **/
    
    public function findAllMainCourses()
    {
        return $this->createQueryBuilder('p')
        ->join('p.category', 'c')
        ->where('c.name = :categoryName')
        ->setParameter('categoryName', 'plat')
        ->orderBy('p.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }
    
    /**
     * @return Product[] Returns an array of Product objects which corresponding to desserts
     */
    
    public function findAllDesserts()
    {
        return $this->createQueryBuilder('p')
        ->join('p.category', 'c')
        ->where('c.name = :categoryName')
        ->setParameter('categoryName', 'dessert')
        ->orderBy('p.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }
    
/*************************************/

    /**
     * @return Product[] Returns an array of Product objects which corresponding to aperitif
    **/

    public function findAllAperitifs()
    {
    return $this->createQueryBuilder('p')
        ->join('p.category', 'c')
        ->where('c.name = :categoryName')
        ->setParameter('categoryName', 'Aperitif')
        ->orderBy('p.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }   

    /**
    * @return Product[] Returns an array of Product objects which corresponding to win
    **/
    
    public function findAllWins()
    {
        return $this->createQueryBuilder('p')
        ->join('p.category', 'c')
        ->where('c.name = :categoryName')
        ->setParameter('categoryName', 'Dessert')
        ->orderBy('p.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }
    
    
    /**
    * @return Product[] Returns an array of Product objects which corresponding to digestifs
    **/
    
    public function findAllDigestifs()
    {
        return $this->createQueryBuilder('p')
        ->join('p.category', 'c')
        ->where('c.name = :categoryName')
        ->setParameter('categoryName', 'Digestif')
        ->orderBy('p.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }
    
    
    /**
    * @return Product[] Returns an array of Product objects sort by category
    **/

    public function findAllProductsByCategory()
    {
    $queryBuilder = $this->createQueryBuilder('p')
        ->select('c.name as category, p.name as product, p.price as price')
        ->leftJoin('p.category', 'c')
        ->orderBy('c.name', 'ASC')
        ->addOrderBy('p.name', 'ASC')
        ->getQuery();

    $results = $queryBuilder->getArrayResult();

    $productsByCategory = [];

    foreach ($results as $result) {
        $category = $result['category'];
        $product = $result['product'];
        $price = $result['price'];

        $productsByCategory[$category][] = [
            'name' => $product,
            'price' => $price
        ];
    }

    return $productsByCategory;
    }
}
