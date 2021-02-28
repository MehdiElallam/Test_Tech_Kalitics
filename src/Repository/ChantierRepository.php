<?php

namespace App\Repository;

use App\Entity\Chantier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chantier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chantier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chantier[]    findAll()
 * @method Chantier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChantierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chantier::class);
    }

    // /**
    //  * @return Chantier[] Returns an array of Chantier objects
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

    
    public function findAllWithDetails()
    {
        $con = $this->getEntityManager()->getConnection();

        $query = '
        SELECT C.id, C.nom, C.adresse, C.date_debut, COUNT(P.user_id) as nombre_employes_pointes , SUM(P.duree) as duree_total
        FROM chantier C
        LEFT JOIN pointage p
        ON C.id = P.chantier_id
        GROUP BY C.id, C.nom, C.adresse, C.date_debut';

        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
    }

    
}
