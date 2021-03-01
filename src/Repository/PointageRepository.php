<?php

namespace App\Repository;

use App\Entity\Chantier;
use App\Entity\User;
use App\Entity\Pointage;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Pointage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pointage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pointage[]    findAll()
 * @method Pointage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointage::class);
    }

    public function findAllWithDetails():array
    {
        $con = $this->getEntityManager()->getConnection();

        $query = '
            SELECT p.id , p.date_pointage , p.duree , u.nom as employe_nom , u.prenom as employe_prenom , c.nom as chantier 
            FROM pointage p , user u, chantier c
            WHERE p.user_id = u.id AND p.chantier_id = c.id 
            ORDER BY p.id DESC';
        
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
       
    }

    public function EmployeePointe($id):array
    {
        $con = $this->getEntityManager()->getConnection();

        $query = '
                SELECT id as pointage_aujourd FROM pointage WHERE user_id = '.$id.' AND DATE(date_pointage) = DATE(now())';
        
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
       
    }

    public function EmployeeHours($id):array
    {
        $con = $this->getEntityManager()->getConnection();

        $query = 'SELECT SUM(duree) AS Total FROM pointage WHERE CAST(date_pointage AS DATE) 
                    BETWEEN CURDATE() AND DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) AND user_id = '.$id;
        
        $stmt = $con->prepare($query);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
       
    }

    

    
}
