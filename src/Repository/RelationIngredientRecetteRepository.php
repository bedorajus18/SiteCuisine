<?php

namespace App\Repository;

use App\Entity\RelationIngredientRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelationIngredientRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelationIngredientRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelationIngredientRecette[]    findAll()
 * @method RelationIngredientRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationIngredientRecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelationIngredientRecette::class);
    }

    // /**
    //  * @return RelationIngredientRecette[] Returns an array of RelationIngredientRecette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RelationIngredientRecette
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
